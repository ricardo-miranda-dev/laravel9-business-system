@extends('template')

@section('title','Crear Producto')

@push('css')

<style>
    #descripcion{
        resize: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
        <h1 class="mt-4"> Crear Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('productos.index')}}">Productos</a></li>
            <li class="breadcrumb-item active">Crear productos</li>
        </ol>
        
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('productos.store')}}" method='post'>
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 mb-2">
                        <label for='codigo' class="form-label">Código:</label>
                        <input type="text" id="codigo" name="codigo" class="form-control" value="{{old('codigo')}}">
                        @error('codigo')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='nombre' class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for='descripcion' class="form-label">Descripción:</label>
                        <textarea  name="descripcion"  id="descripcion" rows="3" class="form-control" >{{old('descripcion')}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div> 
                    <div class="col-md-6 mb-2">
                        <label for='fecha_vencimiento' class="form-label">Fecha de vencimiento:</label>
                        <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento')}}">
                        @error('fecha_vencimiento')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='image_path' class="form-label">Imagen:</label>
                        <input type="file" id="image_path" name="image_path" class="form-control" accept="Image/*">
                        @error('image_path')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='marca' class="form-label">Marca:</label>
                        <select data-size="4" title="Seleccione una marca" data-live-search="true" id="marca" name="marca" class="form-control selectpicker show-tick" >
                            @foreach($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->caracteristica->nombre}}</option>
                            @endforeach
                        </select>   
                        @error('marca')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='presentacion' class="form-label">Presentacion:</label>
                        <select data-size="4" title="Seleccione una presentación" data-live-search="true" id="presentacion" name="presentacion" class="form-control selectpicker show-tick" >
                            @foreach($presentaciones as $presentacione)
                            <option value="{{$presentacione->id}}">{{$presentacione->caracteristica->nombre}}</option>
                            @endforeach
                        </select>  
                        @error('presentacion')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='categoria' class="form-label">Categorias:</label>
                        <select data-size="4" title="Seleccione las categorias" data-live-search="true" id="categoria" name="categoria" class="form-control selectpicker show-tick" multiple>
                            @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->caracteristica->nombre}}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror                        
                    </div>
                    <div class="col-md-12">
                        <button  type="submit" class="btn btn-primary">Guardar</button>
                    </div> 
                </div>
            </form>
        </div>
                        
                        
</div>
                        
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
$(document).ready(function () {
    $('.selectpicker').selectpicker();
});
</script>
@endpush


