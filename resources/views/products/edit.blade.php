@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <h2 class="text-center ">Editar usuario</h2>
        
    </div> 
    


    <div class="col-12 mt-5">
        <form action="{{ route('product.update', [$product])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
            
            <div class="form-group col-12  {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Nombre*</label>
                <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"value="{{ old('name', isset($product) ? $product->name : '') }}">
              
            </div>

            <div class="form-group col-12  {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">Precio Unico*</label>
                <input type="text" id="price" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"value="{{ old('price', isset($product) ? $product->price : '') }}">
              
            </div>

            <div class="form-group col-12  {{ $errors->has('details') ? 'has-error' : '' }}">
                <label for="details">Detalles*</label>
                <textarea id="details" name="details" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}">{{ old('details', isset($product) ? $product->details : '') }}</textarea>
              
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
                <a class="btn btn-info" href="{{ route('product.index') }}">
                    Volver
                </a>
                <input class="btn btn-success" type="submit" value="Guardar  ">
                 
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
