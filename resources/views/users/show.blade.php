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
                        {{ $user->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                         CI:
                    </th>
                    <td>
                        {{ $user->ci ?? '' }}
                    </td>
                </tr>
               <tr>
                    <th>
                        Correo
                    </th>
                    <td>
                       {{ $user->email?? '' }}
                    </td>
                </tr>
                <tr>
                     <th>
                           Fecha de creación:
                    </th>
                    <td>
                        {{ $user->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                            Fecha de actualizacion:
                    </th>
                    <td>
                        {{ $user->updated_at ?? '' }}
                    </td>
                </tr>
                   
            </tbody>
        </table>
    </div>
</div>
<div class="col-12 d-flex justify-content-between">
                <a class="btn btn-info" href="{{ route("user.index") }}">
                    Volver
                </a>
               
            </div>

@endsection