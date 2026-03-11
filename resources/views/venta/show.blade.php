@extends('template')

@section('title','Ver venta')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" type="text/css" />
@endpush

@section('content')
<div class="container-fluid px-4">
        <h1 class="mt-4"> Ver Venta</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Ventas</a></li>
            <li class="breadcrumb-item active">Ver venta</li>
        </ol>
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-file"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Tipo de comprobante: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{$venta->comprobante->tipo_comprobante}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Número de comprobante: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{$venta->numero_comprobante}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Cliente: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{$venta->cliente->persona->razon_social}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Registra: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{$venta->user->name}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Fecha: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d-m-Y')}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Hora: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('H:i')}} '>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                    <input disabled type="text" class="form-control" name="" id="" placeholder="" value='Impuesto: '>
                    </div>
                </div>
                <div class="col-sm-8">                    
                    <input disabled type="text" class="form-control" name="input_impuesto" id="input_impuesto" placeholder="" value='{{ $venta->impuesto}}'>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-table me-1"></i>
                    Tabla detalle de la venta
                </div>
                <div class="card-body table-responsive">
                    <table id="tabla-detalle" class="table table-striped">
                                            <thead class="table-dark bg-primary text-white" >
                                                <tr>                                                    
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>                                                    
                                                    <th>Precio venta</th>
                                                    <th>Descuento</th>
                                                    <th>Subtotal</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($venta->productos as $item)
                                                <tr>                                                    
                                                    <td>{{$item->nombre}}</td>
                                                    <td>{{$item->pivot->cantidad}}</td>
                                                    <td>{{$item->pivot->precio_venta}}</td>
                                                    <td>{{$item->pivot->descuento}}</td>
                                                    <td class='td-subtotal'>{{($item->pivot->cantidad)*($item->pivot->precio_venta)-($item->pivot->descuento)}}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th class="text-end">Subtotal: </th>
                                                    <th class="text" ><span id="sumas"></span></th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th class="text-end">IVA: </th>
                                                    <th class="text"><span id="iva"></span></th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th class="text-end">Total: </th>
                                                    <th class="text"><input type="hidden" name="total" value="0" id="inputTotal"><span id="total"></span></th>
                                                    
                                                </tr>
                                            </tfoot>
                                        </table>
                </div>
            </div>
            
        </div>    
</div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2" ></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
<script>
    let filasSubtotal = document.getElementsByClassName('td-subtotal');
    let  cont = 0;
    let impuesto = $('#input_impuesto').val();
    let total =
    $(document).ready(function(){
        for(let i =0; i <filasSubtotal.length;i++){
            cont+= parseFloat(filasSubtotal[i].innerHTML);
        }
        let total = parseFloat(cont) + parseFloat(impuesto);
        $('#sumas').html(cont);
        $('#iva').html(impuesto);
        $('#total').html(total);
    });
    
</script>
@endpush

