<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'ci' => 'required|string'            
         ]);

        if ($validator->fails()) {
            
           return redirect()
                        ->route('user.create')
                        ->withErrors($validator)
                        ->withInput();
            }
        User::create($request->all());
        $users = User::paginate(10);
        $notification = 'Usuario agregada con exito.';
        return view('users.index', compact('users', 'notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $orders=$user->orders()->get();
        return view('users.show', compact('orders','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'ci' => 'required|string'     
         ]);

        if ($validator->fails()) {
            
            return redirect()
                         ->route('user.edit', $user)
                         ->withErrors($validator)
                         ->withInput();
        }

        User::findOrFail($user->id)->update($request->all());
        $users = User::paginate(10);
        $notification = 'Usuario actualizado con exito.';
        return view('users.index', compact('users', 'notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();  
        $users = User::all();     
        $notification = 'Usuario Eliminado con exito';
        return view('users.index', compact('users','notification' ));
    }
}
