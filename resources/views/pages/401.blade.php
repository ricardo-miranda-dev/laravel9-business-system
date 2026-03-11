<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistema de Gestión" />
        <meta name="author" content="ricardo-miranda-dev" />
        <title>401 Error</title>

        <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
       
        
    </head>
    
    <body class="sb-nav-fixed">
        <div class="container-fluid">

            <!-- 401 Error Text -->
            <div class="text-center mt-4">
                <h1 class="display-1">401</h1>
                <p class="lead text-gray-800 mb-5">No autorizado</p>
                <p class="text-gray-500 mb-0">
                    No tienes permisos para acceder a esta página.
                </p>

                <a href="{{ route('login') }}">&larr; Iniciar Sesión</a>
            </div>

        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
       
       
    </body>
   
</html>


