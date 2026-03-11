@extends('template')

@section('title','Crear Venta')

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
        <h1 class="mt-4"> Crear Venta</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Ventas</a></li>
            <li class="breadcrumb-item active">Crear Venta</li>
        </ol>
        
        <form action="{{ route('ventas.store')}}" method='post' >
            @csrf
            <div class="container mt-4">
                <div class="row gy-4">
                    <!-- Compra producto -->
                    <div class="col-md-8">
                        <div class="text-white p-1 bg-primary text-center">
                            Detalles de la venta
                        </div>  
                        <div class="p-3 border border-3 border-primary">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for='producto_id' class="form-label">Producto:</label>
                                    <select name="producto_id" id="producto_id" class="form-control selectpicker show-tick" data-live-search="true" title="Seleccione el producto">
                                        @foreach ($productos as $item)
                                        <option value="{{$item->id}}_{{$item->stock}}_{{$item->precio_venta}}">{{$item->codigo}}-{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end gy-4">
                                    <div class="col-md-6 mb-2">
                                        <div class="row">
                                            <label for="stock" class="form-label col-sm-4 text-end">En stock:</label>
                                            <div class="col-sm-8">
                                                <input disabled type="text" name="stock" id="stock" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <label for='cantidad' class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="">
                                </div>
                                
                                <div class="col-md-4">
                                    <label for='precio_venta' class="form-label">Precio de venta:</label>
                                    <input disabled type="number" name="precio_venta" id="precio_venta" class="form-control" placeholder="" step="0.1">
                                </div>
                                <div class="col-md-4">
                                    <label for='descuento' class="form-label">Descuento:</label>
                                    <input type="number" name="descuento" id="descuento" class="form-control" placeholder="" step="0.1">
                                </div>
                                <div class="col-mb-12 gy-4 text-end">
                                    <button id="btn-agregar" type="button" class="btn btn-primary">Agregar</button>
                                </div>
                                <!-- Tabla detalles de la compra -->
                                <div class="col-md-12 gy-4">
                                    <div class="table-responsive">
                                        <table id="tabla-detalle" class="table table-hover">
                                            <thead class="table-dark bg-primary text-white" >
                                                <tr>
                                                    <th>Nro</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio venta</th>
                                                    <th>Descuento</th>
                                                    <th>Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th class="text-end">Subtotal: </th>
                                                    <th class="text-end" ><span id="sumas"></span></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th class="text-end">IVA: </th>
                                                    <th class="text-end"><span id="iva"></span></th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th class="text-end">Total: </th>
                                                    <th class="text-end"><input type="hidden" name="total" value="0" id="inputTotal"><span id="total"></span></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelarModal">Cancelar Venta</button>

                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- Producto -->
                    <div class="col-md-4">
                        <div class="text-white p-1 bg-secondary text-center">
                            Datos generales
                        </div>  
                        <div class="p-3 border border-3 border-secondary">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for='cliente_id' class="form-label">Cliente:</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control selectpicker show-tick" data-live-search="true" title="Seleccione" data-size="4">
                                        @foreach ($clientes as $item)
                                            <option value="{{$item->id}}">{{$item->persona->razon_social}}</option>
                                        @endforeach                                                 
                                    </select>
                                    @error('cliente_id') 
                                        <small class='text-danger'>{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for='comprobante_id' class="form-label">Tipo comprobante:</label>
                                    <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker show-tick"  title="Seleccione" >
                                        @foreach ($comprobantes as $item)
                                            <option value="{{$item->id}}">{{$item->tipo_comprobante}}</option>
                                        @endforeach                                                 
                                    </select>
                                    @error('comprobante_id') 
                                        <small class='text-danger'>{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for='numero_comprobante' class="form-label">Número de comprobante:</label>
                                    <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" placeholder="">
                                    @error('numero_comprobante') 
                                        <small class='text-danger'>{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for='impuesto' class="form-label">Impuesto(IVA):</label>
                                    <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-secondary" >
                                    @error('impuesto') 
                                        <small class='text-danger'>{{ '*'.$message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for='fecha' class="form-label">Fecha:</label>
                                    <input readonly type="text" name="fecha" id="fecha" class="form-control border-secondary" value="<?php echo date('Y-m-d') ?>" >
                                    <?php  
                                    use Carbon\Carbon;
                                    $fecha_hora = Carbon::now()->toDateTimeString();
                                    ?>                                    
                                    <input readonly type="hidden" name="fecha_hora" id="fecha_hora" value="{{$fecha_hora}}">
                                </div>
                                
                                <input type="hidden" name="user_id" id="user_id"  value="{{auth()->user()->id}}">
                                
                                <div class="col-md-12 gy-4 text-center">
                                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>

                                </div>
                            </div>
                        </div>
                    </div> 
                </div>                
            </div>            
        </form>
        
        <!-- Modal -->
        <div class="modal fade" id="cancelarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                ¿Seguro que deseas anular la venta?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="btncancelarVenta" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
              </div>
            </div>
          </div>
        </div>

                        
                        
</div>
                        
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('#producto_id').change(mostrarValores);
        disableButtons();
//        
        $('#btn-agregar').click(function(){
            agregarProducto();            
        });
//        
        $('#impuesto').val(impuesto+'%');
//        
        $('#btncancelarVenta').click(function(){            
            cancelarVenta();
            
        });
    });
    
    function mostrarValores(){
        let dataProducto = document.getElementById('producto_id').value.split("_");
        $('#stock').val(dataProducto[1]);
        $('#precio_venta').val(dataProducto[2]);
        //console.log(dataProducto);
    }
    
    let cont =0;
    let subtotal = [];
    let sumas =0;
    let iva=0;
    let total= 0;
    
    const impuesto = 15;
    
    function disableButtons(){
        if(total==0){
            $('#guardar').hide();
            $('#cancelar').hide();
        }else{
            $('#guardar').show();
            $('#cancelar').show();
        }
    }
    
    function cancelarVenta(){
        $('#tabla-detalle > tbody').empty();
        let fila = '<tr>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                        '<td></td>'+
                    '</tr>';
        $('#tabla-detalle').append(fila);
        $('#sumas').html(0);sumas=0;
        $('#iva').html(0);iva=0;
        $('#total').html(0);total=0;cont=0;subtotal=[];
        limpiarCampos();
        disableButtons();
        $('#impuesto').val(iva);
        $('#inputTotal').val(total);
    }
    
    function agregarProducto(){
        let dataProducto = document.getElementById('producto_id').value.split("_");
        let idProducto = dataProducto[0];
        let Producto = $('#producto_id option:selected').text();
        let nameProducto = Producto.split("-")[1];
        let cantidad = $('#cantidad').val();
        let precio_venta = $('#precio_venta').val();
        let descuento = $('#descuento').val();
        let stock = $('#stock').val();
        
        if(descuento == ''){
            descuento=0;
        }
        
        //Validaciones
        if (idProducto!=''&&cantidad!='') {
            if(parseInt(cantidad) > 0 && parseInt(cantidad)%1==0 && parseFloat(descuento) >= 0 && parseFloat(precio_venta) > 0){
                if(parseFloat(cantidad) <= parseFloat(stock)){
                    subtotal[cont]=(cantidad*precio_venta - descuento);
                    sumas+=subtotal[cont];
                    iva = Number(((sumas/100)*impuesto).toFixed(2));
                    total=sumas+iva;
                    $('#impuesto').val(iva);
                    $('#inputTotal').val(total);

                    let fila='<tr id="fila'+cont+'">'+                  
                                '<td>'+(cont+1)+'</td>'+
                                '<td><input type="hidden" name="arrayidproducto[]" value="'+idProducto+'">'+nameProducto+'</td>'+
                                '<td><input type="hidden" name="arraycantidad[]" value="'+cantidad+'">'+cantidad+'</td>'+
                                '<td><input type="hidden" name="arrayprecioventa[]" value="'+precio_venta+'">'+precio_venta+'</td>'+
                                '<td><input type="hidden" name="arraydescuento[]" value="'+descuento+'">'+descuento+'</td>'+
                                '<td>'+subtotal[cont]+'</td>'+
                                '<td><button type="button" class="btn btn-danger" onclick="eliminarProducto('+cont+')"><i class="fa-solid fa-trash"></i></button></td>'+
                              '</tr>';
                    $('#tabla-detalle').append(fila);  
                    limpiarCampos();
                    cont++;
                    disableButtons();

                    $('#sumas').html(sumas.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    $('#iva').html(iva.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    $('#total').html(total.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }else{
                    showModal('Stock insuficiente', 'error');
                }
                
                
            }else{
                showModal('Valores incorrectos', 'error');
            }
            
            
        } else {
            showModal('Faltan campos por llenar', 'error');
        }
        
        
    }
    
    function eliminarProducto(id){
        sumas-=(subtotal[id]);
        iva = Number(((sumas/100)*impuesto).toFixed(2));
        total=sumas+iva;
        $('#impuesto').val(iva);
        
        $('#fila'+id).remove();
        
        
        $('#sumas').html(sumas.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        $('#iva').html(iva.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        $('#total').html(total.toFixed(2)+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
        disableButtons();
    }
    
    function showModal(message, icon){
        const   Toast = Swal.mixin({
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
                icon: icon,
                title: message
              });
    }
    
    function limpiarCampos(){
        let select = $('#producto_id');
        select.selectpicker();
        select.selectpicker('val','');
        $('#cantidad').val('');
        $('#descuento').val('');
        $('#stock').val('');
        $('#precio_venta').val('');
    }
</script>

@endpush




