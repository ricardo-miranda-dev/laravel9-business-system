@extends('template')

@section('title','Editar Usuario')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<style>
    #descripcion{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
        <h1 class="mt-4"> Editar Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
        </ol>
        
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('users.update',['user' =>$user])}}" method='post'>
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    
                    <div class="row mb-4 mt-4">
                        <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{old('name',$user->name)}}">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escriba un solo nombre
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('name')
                            <small class="text-danger">{{'* '.$message}}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-4 ">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{old('email',$user->email)}}">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escriba un email valido
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('email')
                            <small class="text-danger">{{'* '.$message}}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-4 ">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password" placeholder="" value="">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Escriba una contraseña
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('password')
                            <small class="text-danger">{{'* '.$message}}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-4 ">
                        <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="" value="">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Confirme su contraseña
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('password_confirm')
                            <small class="text-danger">{{'* '.$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4 ">
                        <label for="role" class="col-sm-2 col-form-label">Seleccionar rol:</label>
                        <div class="col-sm-4">
                            <select name="role" id="role" class="form-control selectpicker show-tick" data-live-search="true" title="Seleccione">
                                @foreach ($roles as $item)
                                @if(in_array($item->name,$user->roles->pluck('name')->toArray()))
                                    <option selected value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->name}}" @selected(old('role')==$item->name)>{{$item->name}}</option>
                                @endif
                                
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-text">
                                Confirme su contraseña
                            </div>
                        </div>
                        <div class="col-sm-2">
                            @error('password_confirm')
                            <small class="text-danger">{{'* '.$message}}</small>
                            @enderror
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush


