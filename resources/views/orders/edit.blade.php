@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <h2 class="text-center ">EDIAR UNA ORDEN</h2>
        
    </div> 
    


    <div class="col-12 mt-5">
        <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="form-group col-12{{ $errors->has('user_id') ? 'has-error' : '' }}">
                <label for="user_id">Usuario*</label>
                <select name="user_id" id="user_id" class="form-control select2 w-100" >
                    @foreach($users as $id => $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name}} - {{ $user->ci}}
                        </option>
                    @endforeach
                </select>
            </div>
                
            <div class="form-group col-12  {{ $errors->has('tax') ? 'has-error' : '' }}">
                <label for="tax">Impuesto*</label>
                <input type="text" id="tax" name="tax" class="validarletras   form-control{{ $errors->has('tax') ? ' is-invalid' : '' }}" value="{{ old('tax', isset($order) ? $order->tax : '')}}">
              
            </div>

            <div class="form-group col-12{{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Estado*</label>
                <select name="status" id="status" class="form-control select2 w-100" >
                <option value="0" @if(!$order->status) selected @else '' @endif>
                            Desactivo
                        </option>
                        <option value="1" @if($order->status) selected @else '' @endif>
                            Activo
                        </option>
                    
                </select>
            </div>

            
            <div class="form-group  col-12 {{ $errors->has('comments') ? 'has-error' : '' }}">
                <label for="comments">Comentario*</label>
                <textarea name="comments" id="comments"  class="form-control{{$errors->has('comments') ? ' is-invalid' : '' }}" >{{ old('details', isset($order) ? $order->comments : '') }} </textarea>

                
            </div>
            
            <div class="col-12 ">  
    
        <h5 class="text-center my-5 col-12">Productos:</h5>
        <div class="table-responsive row">
            <table class=" table table-bordered table-striped table-hover  col-12" id='userTable'>
                <thead>
                    <tr>                                               
                        
                        <th>Nombre - Precio</th>
                              
                    </tr>
                </thead>
                <tbody  value=2>  
                @foreach($products as $id => $products)                 
                        <tr data-entry-id=" ">
                        
                        <td>
                        <input name="products_price[]" class="d-none" type="checkbox" id="price-{{$id}}" value="{{$products->price}}" {{ (in_array($id, old('product', [])) || isset($order) && $order->products->contains($id)) ? 'checked' : '' }}/>        
                        <input name="products[]" type="checkbox" id="{{$id}}" value="{{$products->id}}" {{ (in_array($id, old('product', [])) || isset($order) && $order->products->contains($id)) ? 'checked' : '' }}/>
                                        {{ $products->name }} - {{ $products->price }}
                                
                            </td>
                        </tr>
                        @endforeach
                        

                  
                </tbody>
            </table>
        </div>  



    
</div>
          
            <!--*           Errores         -->
            @if($errors->all())
            <div class="col-12 text-white bg-danger p-3 mb-2 col-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                 

            <div class="col-12 d-flex justify-content-between">
                <a class="btn btn-info" href="{{ route('order.index') }}">
                    Volver
                </a>
                <input class="btn btn-success" type="submit" value="Guardar  ">
                 
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@parent


    <script type='text/javascript'>
    $("input[name='products[]']:checkbox").change(function(){
        id=$(this).prop('id');
        if($(this).prop('checked') == true){
            $("#price-"+id).prop('checked',true);
        }else{
            $("#price-"+id).prop('checked',false);
        }            
        });
   </script>

@endsection