@extends('template')

@section('title','productos')

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
                        <h1 class="mt-4">Productos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">Productos</li>
                        </ol>
                        <div class="mb-4">
                            <a href="{{route('productos.create')}}">
                                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
                            </a>
                        </div>
                         
                        
                           <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Productos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>                                        
                                            <th>Marca</th>
                                            <th>Presentación</th>
                                            <th>Categorias</th>
                                            <th>Estado</th> 
                                            <th>Acción</th>                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $producto)
                                        <tr>
                                            <td>{{$producto->codigo}}</td>
                                            <td>{{$producto->nombre}}</td>                                           
                                            <td>{{$producto->marca->caracteristica->nombre}}</td>
                                            <td>{{$producto->presentacione->caracteristica->nombre}}</td>
                                            <td>
                                                @foreach($producto->categorias as $categoria)
                                                <div class='container'>
                                                    <div class='row'>
                                                        <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{$categoria->caracteristica->nombre}}</span>                                                   </div>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($producto->estado==1)
                                                <span class="fw-bolder p-1 rounded bg-primary text-white text-center">Activo</span>
                                                @else
                                                 <span class="fw-bolder p-1 rounded bg-danger text-white text-center">Eliminado</span>
                                                @endif 
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('productos.edit',['producto' =>$producto])}}" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info">Editar</button>                                                        
                                                    </form>
                                                    <button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#verModal-{{$producto->id}}">Ver</button>
                                                    @if($producto->estado==1)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$producto->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$producto->id}}">Restaurar</button>
                                                    @endif
                                              </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="confirmModal-{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                     
                                                      {{$producto->estado == 1 ? '¿Seguro que quieres eliminar este producto? ':'¿Seguro que quieres restaurar este producto? ' }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form action='{{route('productos.destroy',['producto' => $producto->id])}}' method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Confirmar</button> 
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="verModal-{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Detalles del  producto</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <label for=''><span class="fw-bolder">Descripción:</span> {{$producto->descripcion}}</label>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for=''><span class="fw-bolder">Fecha de vencimiento:</span> {{$producto->fecha_vencimiento==''?'No  tiene':$producto->fecha_vencimiento}}</label>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for=''><span class="fw-bolder">Stock:</span> {{$producto->stock}}</label>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="fw-bolder">Imagen:</label>
                                                        <div>
                                                            @if($producto->img_path != null)
                                                                <img  src="{{ Storage::url('productos/'.$producto->img_path)}}"  alt="{{$producto->nombre}}" class='img-fluid .img-thumbnail border border-4 rounded'>
                                                            @else
                                                                <img  src=""  alt="{{$producto->nombre}}" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                 
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


