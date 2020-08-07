@extends('layouts.app')
@section('content')

<div class="row">
      
        <div class="col-12">
        <h5 class="text-center ">Datos del Usuario</h5>
    
        </div>


    <div class="col-12">
        <table class="table mt-5 table-hover">
            <tbody>
                <tr>
                    <th>
                        Nombre:
                    </th>
                    <td>
                        {{ $order->user->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                         CI:
                    </th>
                    <td>
                        {{ $order->user->ci ?? '' }}
                    </td>
                </tr>
               <tr>
                    <th>
                        Correo
                    </th>
                    <td>
                       {{ $order->user->email?? '' }}
                    </td>
                </tr>

                <tr>
                    <th>
                        Total
                    </th>
                    <td>
                       {{ $order->total?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                    Comentarios
                    </th>
                    <td>
                       {{ $order->comments?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Estado
                    </th>
                    <td>
                       {{ $order->status?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Impuesto
                    </th>
                    <td>
                       {{ $order->tax?? '' }}
                    </td>
                </tr>




                <tr>
                     <th>
                           Fecha de creación:
                    </th>
                    <td>
                        {{ $order->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                            Fecha de actualizacion:
                    </th>
                    <td>
                        {{ $order->updated_at ?? '' }}
                    </td>
                </tr>
                   
            </tbody>
        </table>
    </div>
</div>

<div class="col-12 mt-5">

        <h5 class="text-center ">Datos del Producto</h5>
    
        </div>

        
        <div class="col-12 mt-5">

        @if(count($order->products)>0)

                <h5 class="text-center ">Datos del Producto</h5>
            
                </div>


            <div class="col-12">
            
                <table class="table mt-5 table-hover" >
                <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Detalle</th>
                            
                        </tr>
                    </thead>
                    
                    @foreach($order->products as $key => $product )
                        <tr>
                            <th scope="col">{{$loop->index+1}}</th>
                            <th scope="col">{{$product->name}}</th>
                            <th scope="col">{{$product->price}}</th>
                            <th scope="col">{{$product->details}}</th>

                        </tr>
                    @endforeach
                    </tbody>
                    </table>
            </div>

            @else


            <h3 class="text-center">NO HAY PRODUCTOS ASOCIADOS A LA ORDEN</h3>

            @endif



<div class="col-12 d-flex justify-content-between">
                <a class="btn btn-info" href="{{ route("order.index") }}">
                    Volver
                </a>
                
                <a class="btn btn-xs btn-secondary" href="{{ route('imprimir', $order->id) }}">
Imprimir                        </a>
               
            </div>

@endsection