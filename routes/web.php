<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');
//Route::get('/panel', function () {
//    return view('panel.index');
//});

//Route::view('/categorias', 'categoria.index')->name('categorias');

//Route::resource('categorias', CategoriaController::class);
//
//Route::resource('presentaciones', PresentacionController::class);
//
//Route::resource('marcas', MarcaController::class);
//
//Route::resource('clientes', ClienteController::class);
//
//Route::resource('productos', ProductoController::class);

Route::resources([
    'categorias' => CategoriaController::class,
    'presentaciones' => PresentacionController::class,
    'marcas' => MarcaController::class,
    'productos' => ProductoController::class,
    'clientes' => ClienteController::class,
    'proveedores' => ProveedorController::class,
    'compras' => CompraController::class 
]);


Route::get('/login', function () {
    return view('auth.login');
});