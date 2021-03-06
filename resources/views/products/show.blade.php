@extends('layouts.app')
@section('content')

<div class="row">
      
        <div class="col-12">
        <h5 class="text-center ">Datos del Producto</h5>
    
        </div>


    <div class="col-12">
        <table class="table mt-5 table-hover">
            <tbody>
                <tr>
                    <th>
                        Nombre:
                    </th>
                    <td>
                        {{ $product->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                         Precio:
                    </th>
                    <td>
                        {{ $product->price ?? '' }}
                    </td>
                </tr>
               <tr>
                    <th>
                        Detalle:
                    </th>
                    <td>
                       {{ $product->details?? '' }}
                    </td>
                </tr>
                <tr>
                     <th>
                           Fecha de creación:
                    </th>
                    <td>
                        {{ $product->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                            Fecha de actualizacion:
                    </th>
                    <td>
                        {{ $product->updated_at ?? '' }}
                    </td>
                </tr>
                   
            </tbody>
        </table>
    </div>
</div>
<div class="col-12 d-flex justify-content-between">
                <a class="btn btn-info" href="{{ route("product.index") }}">
                    Volver
                </a>
               
            </div>

@endsection