@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12 text-right">
            <a class="btn btn-success " href="{{ route('product.create') }}">
                Agregar Nuevo Producto
            </a>
            <a class="btn btn-secondary " href="{{ route('product.create') }}">
                Descargar Datos
            </a>
        </div>
        <div class="col-lg-12 ">
            <h2>Producto</h2>
            <hr>
            <table class="table mt-5 table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($products as $key => $product )
                <tr>
                    <th scope="col">{{$loop->index+1}}</th>
                    <th scope="col">{{$product->name}}</th>
                    <th scope="col">{{$product->price}}</th>
                    <th scope="col">{{$product->details}}</th>
                    <th scope="col">
                        <a class="btn btn-xs btn-success w-100" href="{{ route('product.show', $product->id) }}">
                            Ver
                        </a>
                    
                        <a class="btn btn-xs btn-info w-100" href="{{ route('product.edit', $product) }}">
                            Editar
                        </a>
                    
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="w-100 d-inline-block formularioEliminar" id="formularioEliminar{{$product->id}}" 
                            >
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button id="eliminar" class="btn w-100 btn-xs btn-danger eliminar" value="{{$product->id}}">Eliminar</button>
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
            </table>

        </div>
        <div class="col-12">
        @if(isset($notification))
        <div class="alert alert-success"  role="alert">
            {{$notification}}
        </div>
        @endif
        </div>
    </div>

@endsection
