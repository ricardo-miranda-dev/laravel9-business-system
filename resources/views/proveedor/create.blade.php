@extends('template')

@section('title','Crear Proveedor')

@push('css')

<style>
    #box-razon-social{
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
        <h1 class="mt-4"> Crear Proveedor</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('proveedores.index')}}">Proveedores</a></li>
            <li class="breadcrumb-item active">Crear proveedores</li>
        </ol>
        
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('proveedores.store')}}" method='post' >
                @csrf
                <div class="row g-3">
                    <div class="col-md-4 mb-2">
                        <label for='tipo_persona' class="form-label">Tipo proveedor:</label>
                        <select class="form-select" id="tipo_persona" name="tipo_persona" >
                            <option value="" selected disabled>Seleccione un tipo de proveedor</option>
                            <option value="natural" {{old('tipo_persona')=='natural'?'selected':''}}>Natural</option>
                            <option value='juridica' {{old('tipo_persona')=='juridica'?'selected':''}}>Jurídica</option>
                        </select>
                        @error('tipo_persona')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-2" id='box-razon-social'>
                        <label id='label-natural' for='razon_social' class="form-label">Nombres y apellidos:</label>
                        <label id='label-juridico' for='razon_social' class="form-label">Nombre de la empresa:</label>
                        <input type="text" id="razon_social" name="razon_social" class="form-control" value="{{old('razon_social')}}">
                        @error('razon_social')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for='descripcion' class="form-label">Dirección:</label>
                        <input type="text"  name="direccion"  id="direccion" rows="3" class="form-control" value="{{old('direccion')}}">
                        @error('direccion')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div> 
                    <div class="col-md-6 mb-2">
                        <label for='documento_id' class="form-label">Tipo de documento:</label>
                        <select data-size="4" title="Seleccione un tipo de documento" data-live-search="true" id="documento_id" name="documento_id" class="form-control selectpicker show-tick" >
                            @foreach($documentos as $documento)
                            <option value="{{$documento->id}}" {{old('documento_id')==$documento->id?'selected':''}}>{{$documento->tipo_documento}}</option>
                            @endforeach
                        </select>  
                        @error('documento_id')
                        <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for='numero_documento' class="form-label">Número de documento:</label>
                        <input type="text" id="numero_documento" name="numero_documento" class="form-control" value="{{old('numero_documento')}}">
                        @error('numero_documento')
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
    $('#tipo_persona').on('change',function(){
        let selectValue = $(this).val();
        if(selectValue=='natural'){
            $('#label-natural').show();
            $('#label-juridico').hide();
        }else{
            $('#label-juridico').show();
            $('#label-natural').hide();
        }
        $('#box-razon-social').show();
    });
});
</script>
@endpush




