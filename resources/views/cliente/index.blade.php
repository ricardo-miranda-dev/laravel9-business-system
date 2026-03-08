@extends('template')

@section('title','clientes')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" type="text/css" />
@endpush

@section('content')
@if(session('success'))
<script>
    let message = "{{session('success')}}";
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
    Toast.fire({
      icon: "success",
      title: message
    });
</script>
@endif
<div class="container-fluid px-4">
                        <h1 class="mt-4">Clientes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">Clientes</li>
                        </ol>
                        <div class="mb-4">
                            <a href="{{route('clientes.create')}}">
                                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
                            </a>
                        </div>
                         
                        
                           <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Clientes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="table table-striped ">
                                    <thead>
                                        <tr>
                                            
                                            <th>Nombre</th>                                        
                                            <th>Dirección</th>
                                            <th>Documento</th>
                                            <th>Tipo de Cliente</th>
                                            <th>Estado</th> 
                                            <th>Acción</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{$cliente->persona->razon_social}}</td>
                                            <td>{{$cliente->persona->direccion}}</td>                                           
                                            <td>
                                                <p class="fw-normal mb-1">{{$cliente->persona->documento->tipo_documento}}</p>
                                                <p class="text-muted mb-0">{{$cliente->persona->numero_documento}}</p>
                                            </td>
                                            <td>{{strtoupper($cliente->persona->tipo_persona)}}</td>
                                            
                                            <td>
                                                @if($cliente->persona->estado==1)
                                                <span class="fw-bolder p-1 rounded bg-primary text-white text-center">Activo</span>
                                                @else
                                                 <span class="fw-bolder p-1 rounded bg-danger text-white text-center">Eliminado</span>
                                                @endif 
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('clientes.edit',['cliente' =>$cliente])}}" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info">Editar</button>                                                        
                                                    </form>
                                                    
                                                    @if($cliente->persona->estado==1)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">Restaurar</button>
                                                    @endif
                                              </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="confirmModal-{{$cliente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                     
                                                      {{$cliente->persona->estado == 1 ? '¿Seguro que quieres eliminar este cliente? ':'¿Seguro que quieres restaurar este cliente? ' }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form action='{{route('clientes.destroy',['cliente' => $cliente->id])}}' method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Confirmar</button> 
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2" ></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush


