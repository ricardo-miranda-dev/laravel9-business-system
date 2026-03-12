@extends('template')

@section('title','Panel')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
@if(session('success'))
<script>
    let message = "{{session('success')}}";
    let timerInterval;
Swal.fire({
  title: message,
        showClass: {
          popup: `
            animate__animated
            animate__fadeInUp
            animate__faster
          `
        },
        hideClass: {
          popup: `
            animate__animated
            animate__fadeOutDown
            animate__faster
          `
        },
  html: "Cargando Módulos <b></b> DataFact.",
  timer: 2700,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading();
    const timer = Swal.getPopup().querySelector("b");
    timerInterval = setInterval(() => {
      timer.textContent = `${Swal.getTimerLeft()}`;
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval);
  }
}).then((result) => {
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log("Módulos Cargados");
  }
});
   
</script>
@endif
<div class="container-fluid px-4">
                        <h1 class="mt-4">Panel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Panel principal</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Clientes</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Cliente;
                                                $clientes = count(Cliente::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$clientes}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('clientes.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Ventas</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Venta;
                                                $ventas = count(Venta::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$ventas}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('ventas.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Proveedores</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Proveedore;
                                                $proveedores = count(Proveedore::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$proveedores}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('proveedores.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Compras</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Compra;
                                                $Compra = count(Compra::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$Compra}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('compras.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Productos</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Producto;
                                                $Productos = count(Producto::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$Productos}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('productos.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Marcas</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Marca;
                                                $Marcas = count(Marca::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$Marcas}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('marcas.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Categorías</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Categoria;
                                                $Categoria = count(Categoria::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$Categoria}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('categorias.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <i class="fa-solid fa-handshake"></i><span> Presentaciones</span>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                use App\Models\Presentacione;
                                                $Presentaciones = count(Presentacione::all());
                                                ?>
                                                <p class="text-center fw-bold fs-4">{{$Presentaciones}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{route('presentaciones.index')}}">Ver más</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Ventas por día
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ventas por mes
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line me-1"></i>
                                Ventas Recientes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Comprobante</th>                                        
                                            <th>Cliente</th>
                                            <th>Fecha y hora</th>
                                            <th>Usuario</th>
                                            <th>Total</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            
                                            $ventasTB = Venta::with('comprobante','cliente.persona','user')
                                                            ->where('estado',1)
                                                            ->latest()->get();
                                        ?>
                                        @foreach($ventasTB as $item)
                                        <tr>
                                            <td>
                                                <p class="fw-semibold mb-1">{{strtoupper($item->comprobante->tipo_comprobante)}}</p>
                                                <p class="text-muted mb-0">{{$item->numero_comprobane}}</p>
                                            </td>
                                            <td>
                                                <p class="fw-semibold mb-1">{{ucfirst($item->cliente->persona->tipo_persona)}}</p>
                                                <p class="text-muted mb-0">{{$item->cliente->persona->razon_social}}</p>
                                            </td>
                                            <td>
                                                {{
                                                    \Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y').' '.   
                                                    \Carbon\Carbon::parse($item->fecha_hora)->format('H:i')
                                                }}
                                            </td>
                                            <td>{{$item->user->name}}</td> 
                                            <td>{{$item->total}}</td>                                      
                                            
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    @can('mostrar-venta')
                                                    <form action="{{route('ventas.show',['venta'=> $item])}}" method="get">
                                                        @method('GET')
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="">Ver</button>
                                                    </form>
                                                    @endcan                                                    
                                              </div>
                                            </td>
                                        </tr>

                                        
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
var ventasLabels = @json($labels);
var ventasData = @json($data);
var ventasLabels2 = @json($labels2);
var ventasData2 = @json($data2);
</script>        
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
        
@endpush