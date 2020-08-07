<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Notifications\OrderSaved;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(5);
        return view('orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('products_price', [])) {
            $request["total"]=array_sum($request->input('products_price'));	
        }else{
            $request["total"]=0;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'total' => 'required',
            'tax' => 'required',
            'status' => 'required|boolean',
            'comments' => 'required|string',
         ]);

        if ($validator->fails()) {
            
           return redirect()
                        ->route('order.create')
                        ->withErrors($validator)
                        ->withInput();
            }
        
        

        $order=Order::create($request->all());
        if ($request->input('products', [])) {
            $order->products()->attach($request->input('products', []));
        }
        $order->notify(new OrderSaved($order));
        $orders = Order::paginate(5);
        $notification = 'orden agregada con exito.';
        return view('orders.index', compact('orders', 'notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $productos=$order->products()->get();
        return view('orders.show', compact('order', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $products = Product::all();
        return view('orders.edit', compact('users', 'products','order'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($request->input('products_price', [])) {
            $request["total"]=array_sum($request->input('products_price'));	
        }else{
            $request["total"]=0;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'total' => 'required',
            'tax' => 'required',
            'status' => 'required|boolean',
            'comments' => 'required|string',
         ]);

        if ($validator->fails()) {
            
            return redirect()
                         ->route('orders.edit', $order)
                         ->withErrors($validator)
                         ->withInput();
        }        

         $products=$order->products()->get();
         $products_input=$request->input('products', []);

         foreach ($products as $product) {
             $encontrado=false;
             foreach ($products_input as $product_input) {
                 if ($product == $product_input){
                     $encontrado=true;
                     $break;
                 }
             }
             if ($encontrado == false){
                $order = Order::findOrFail($order->id);
                $order->products()->detach($order);  

             }
         }

        Order::findOrFail($order->id)->update($request->all());
        
        if ($request->input('products', [])) {
            $order->products()->attach($request->input('products', []));
        }
        $orders = Order::paginate(5);
        $notification = 'orden actualizada con exito.';
        return view('orders.index', compact('orders', 'notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();  
        $orders = Order::paginate(5);     
        $notification = 'Equipo Eliminado con exito';
        return view('orders.index', compact('orders','notification' ));
    }

    public function imprimir(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $pdf = \PDF::loadView('download', compact('order'));
        return $pdf->download('download.pdf');
    }
}
