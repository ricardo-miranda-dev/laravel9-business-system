@extends('template')

@section('title','Editar Producto')

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
        <h1 class="mt-4"> Editar Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('productos.index')}}">Productos</a></li>
            <li class="breadcrumb-item active">Editar productos</li>
        </ol>
        
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('productos.update',['producto'=>$producto])}}" method='post' enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 mb-2">
                        <label for='codigo' class="form-label">Código:</label>
                        <input type="text" id="codigo" name="codigo" class="form-control" value="{{old('codigo',$producto->codigo)}}">
                        @error('codigo')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='nombre' class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{old('nombre',$producto->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for='descripcion' class="form-label">Descripción:</label>
                        <textarea  name="descripcion"  id="descripcion" rows="3" class="form-control" >{{old('descripcion',$producto->descripcion)}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div> 
                    <div class="col-md-6 mb-2">
                        <label for='fecha_vencimiento' class="form-label">Fecha de vencimiento:</label>
                        <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="{{old('fecha_vencimiento',$producto->fecha_vencimiento)}}">
                        @error('fecha_vencimiento')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='img_path' class="form-label">Imagen:</label>
                        <input type="file" id="img_path" name="img_path" class="form-control" accept="image/*">
                        @error('img_path')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='marca' class="form-label">Marca:</label>
                        <select data-size="4" title="Seleccione una marca" data-live-search="true" id="marca_id" name="marca_id" class="form-control selectpicker show-tick" >
                            @foreach($marcas as $marca)
                            @if($marca->id==$producto->marca_id)
                                <option selected value="{{$marca->id}}" {{old('marca_id')==$marca->id?'selected':''}}>{{$marca->nombre}}</option>
                            @else
                                <option value="{{$marca->id}}" {{old('marca_id')==$marca->id?'selected':''}}>{{$marca->nombre}}</option>
                            @endif                            
                            @endforeach
                        </select>   
                        @error('marca_id')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='presentacion' class="form-label">Presentacion:</label>
                        <select data-size="4" title="Seleccione una presentación" data-live-search="true" id="presentacione_id" name="presentacione_id" class="form-control selectpicker show-tick" >
                            @foreach($presentaciones as $presentacione)
                            @if($presentacione->id==$producto->presentacione_id)
                                <option selected value="{{$presentacione->id}}" {{old('presentacione_id')==$presentacione->id?'selected':''}}>{{$presentacione->nombre}}</option>
                            @else
                                <option value="{{$presentacione->id}}" {{old('presentacione_id')==$presentacione->id?'selected':''}}>{{$presentacione->nombre}}</option>
                            @endif 
                            @endforeach
                        </select>  
                        @error('presentacione_id')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='categoria' class="form-label">Categorias:</label>
                        <select data-size="4" title="Seleccione las categorias" data-live-search="true" id="categorias[]" name="categorias[]" class="form-control selectpicker show-tick" multiple>
                            @foreach($categorias as $categoria)
                            @if(in_array($categoria->id,$producto->categorias->pluck('id')->toArray()))
                                <option selected value="{{$categoria->id}}" {{ (in_array($categoria->id, (array)old('categorias',[]))) ? 'selected' : '' }}>{{$categoria->nombre}}</option>
                            @else
                                <option value="{{$categoria->id}}" {{ (in_array($categoria->id, (array)old('categorias',[]))) ? 'selected' : '' }}>{{$categoria->nombre}}</option>
                            @endif 
                            @endforeach
                        </select>
                        @error('categorias[]')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror                        
                    </div>
                    <div class="col-md-12">
                        <button  type="submit" class="btn btn-primary">Actualizar</button>
                        <button  type="reset" class="btn btn-secondary">Resetear</button>
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


