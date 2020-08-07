@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12 text-right">
            <a class="btn btn-success " href="{{ route('user.create') }}">
                Agregar Nuevo Usuario
            </a>
            <a class="btn btn-secondary " href="{{ route('user.create') }}">
                Descargar Datos
            </a>
        </div>
        <div class="col-lg-12 ">
            <h2>Usuario</h2>
            <hr>
            <table class="table mt-5 table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">CI</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user )
                <tr>
                    <th scope="col">{{$loop->index+1}}</th>
                    <th scope="col">{{$user->name}}</th>
                    <th scope="col">{{$user->ci}}</th>
                    <th scope="col">{{$user->email}}</th>
                    <th scope="col">
                        <a class="btn btn-xs btn-success w-100" href="{{ route('user.show', $user->id) }}">
                            Ver
                        </a>
                    
                        <a class="btn btn-xs btn-info w-100" href="{{ route('user.edit', $user) }}">
                            Editar
                        </a>
                    
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="w-100 d-inline-block formularioEliminar" id="formularioEliminar{{$user->id}}" 
                            >
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button id="eliminar" class="btn w-100 btn-xs btn-danger eliminar" value="{{$user->id}}">Eliminar</button>
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
