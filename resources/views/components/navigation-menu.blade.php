<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="{{ route('panel')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Módulos</div>
                            @can('ver-proveedore')
                            <a class="nav-link" href="{{ route('proveedores.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck"></i></div>
                                Proveedores
                            </a>
                            @endcan
                            @can('ver-compra')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsCompras" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                                Compras
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('compras.index')}}">Ver</a>
                                    @can('crear-compra')
                                    <a class="nav-link" href="{{ route('compras.create')}}">Crear</a>
                                    @endcan
                                </nav>
                            </div>
                            @endcan
                            @can('ver-cliente')
                            <a class="nav-link" href="{{ route('clientes.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-handshake"></i></div>
                                Clientes
                            </a>
                            @endcan
                            @can('ver-venta')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsVentas" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Ventas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            
                            <div class="collapse" id="collapseLayoutsVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('ventas.index')}}">Ver</a>
                                    @can('crear-venta')
                                    <a class="nav-link" href="{{ route('ventas.create')}}">Crear</a>
                                    @endcan
                                </nav>
                            </div>
                            @endcan
                            @can('ver-categoria')
                            <a class="nav-link" href="{{ route('categorias.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                                Categorías
                            </a>
                            @endcan
                            @can('ver-presentacione')
                            <a class="nav-link" href="{{ route('presentaciones.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Presentaciones
                            </a>
                            @endcan
                            @can('ver-marca')
                            <a class="nav-link" href="{{ route('marcas.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-earth-americas"></i></div>
                                Marcas
                            </a>
                            @endcan
                            @can('ver-producto')
                            <a class="nav-link" href="{{ route('productos.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-brands fa-shopify"></i></div>
                                Productos
                            </a>                                                      
                            @endcan
                            <div class="sb-sidenav-menu-heading">Otros</div>
                            @can('ver-user')
                            <a class="nav-link" href="{{ route('users.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Usuarios
                            </a>
                            @endcan
                            @can('ver-role')
                            <a class="nav-link" href="{{ route('roles.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-circle-plus"></i></div>
                                Roles
                            </a>
                            @endcan
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Bienvenido:</div>
                        {{auth()->user()->name}}
                    </div>
                </nav>
            </div>
