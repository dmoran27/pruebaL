<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'details' => 'required|string',
            'price' => 'required'            
         ]);

        if ($validator->fails()) {
            
           return redirect()
                        ->route('product.create')
                        ->withErrors($validator)
                        ->withInput();
            }
        Product::create($request->all());
        $products = Product::paginate(10);
        $notification = 'Producto agregada con exito.';
        return view('products.index', compact('products', 'notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'details' => 'required|string',
            'price' => 'required'       
         ]);

        if ($validator->fails()) {
            
            return redirect()
                         ->route('product.edit', $product)
                         ->withErrors($validator)
                         ->withInput();
        }

        Product::findOrFail($product->id)->update($request->all());
        $products = Product::paginate(10);
        $notification = 'Producto actualizado con exito.';
        return view('products.index', compact('products', 'notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();  
        $products = Product::all();     
        $notification = 'Producto Eliminado con exito';
        return view('products.index', compact('products','notification' ));
    }
}
