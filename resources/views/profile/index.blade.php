@extends('template')

@section('title','Ver perfil')

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
        <h1 class="mt-4 text-center"> Configurar perfil</h1>
        
        <form action="{{route('profile.update',['profile'=>$user])}}" method="POST">
        @method('PATCH')
        @csrf
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <div class="mt-2 mb-4">
                @if($errors->any())
                @foreach($errors->all() as $item)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$item}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
                @endif  
            </div>
          
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-circle-user"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Nombre: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input  type="text" class="form-control" name="name" id="name" placeholder="" value='{{old('name',$user->name)}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Email: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input  type="email" class="form-control" name="email" id="email" placeholder="" value='{{old('email',$user->email)}} '>
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Contraseña: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input  type="password" class="form-control" name="password" id="password" placeholder="" value=''>
                </div>
            </div>
            <div class="col text-center">
                 <input type="submit" name="" class="btn btn-primary" value='Guardar cambios'>
            </div>
            
        
            
        </div>  
        </form>
          
</div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2" ></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

@endpush

