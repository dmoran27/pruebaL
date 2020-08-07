@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12 text-right">
            <a class="btn btn-success " href="{{ route('order.create') }}">
                Agregar Nueva Orden
            </a>
            <a class="btn btn-secondary " href="{{ route('order.create') }}">
                Descargar Datos
            </a>
        </div>
        <div class="col-lg-12 ">
            <h2>Ordenes</h2>
            <hr>
            <table class="table mt-5 table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $key => $order )
                <tr>
                    <th scope="col">{{$loop->index+1}}</th>
                    <th scope="col">{{$order->user->name}}</th>
                    <th scope="col">{{$order->user->ci}}</th>
                    <th scope="col">{{$order->user->email}}</th>
                    <th scope="col">{{$order->total}}</th>
                    <th scope="col">{{$order->status}}</th>
                    <th scope="col">
                        <a class="btn btn-xs btn-success w-100" href="{{ route('order.show', $order->id) }}">
                            Ver
                        </a>
                    
                        <a class="btn btn-xs btn-info w-100" href="{{ route('order.edit', $order) }}">
                            Editar
                        </a>
                    
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="w-100 d-inline-block formularioEliminar" id="formularioEliminar{{$order->id}}" 
                            >
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button id="eliminar" class="btn w-100 btn-xs btn-danger eliminar" value="{{$order->id}}">Eliminar</button>
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
            </table>
            {{$orders->links()}}

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
