@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <h2 class="text-center ">AGREGAR UN USUARIO</h2>
        
    </div> 
    


    <div class="col-12 mt-5">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            
            <div class="form-group col-12  {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Nombre*</label>
                <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"value="{{ old('name') }}">
              
            </div>

            <div class="form-group col-12  {{ $errors->has('ci') ? 'has-error' : '' }}">
                <label for="ci">CI*</label>
                <input type="text" id="ci" name="ci" class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}"value="{{ old('ci') }}">
              
            </div>

            <div class="form-group col-12  {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Correo*</label>
                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"value="{{ old('email') }}">
              
            </div>

          
          
            <!--*           Errores         -->
            @if($errors->all())
            <div class="bg-danger p-3 mb-2 col-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                 

            <div class="col-12 d-flex justify-content-between">
                <a class="btn btn-info" href="{{ route('user.index') }}">
                    Volver
                </a>
                <input class="btn btn-success" type="submit" value="Guardar  ">
                 
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
