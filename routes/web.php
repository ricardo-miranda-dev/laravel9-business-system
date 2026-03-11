<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

//Route::get('/', function () {
//    return view('template');
//});
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

Route::get('/', [HomeController::class,'index'])->name('panel');



//Route::resource('productos', ProductoController::class);

Route::resources([
    'categorias' => CategoriaController::class,
    'presentaciones' => PresentacionController::class,
    'marcas' => MarcaController::class,
    'productos' => ProductoController::class,
    'clientes' => ClienteController::class,
    'proveedores' => ProveedorController::class,
    'compras' => CompraController::class,
    'ventas' => VentaController::class,
    'users' => UserController::class,
    'roles' => RoleController::class
]);

Route::get('/401', function () {
    return view('pages.401');
});

//Route::get('/login', function () {
//    return view('auth.login');
//});
//Route::view('/panel', 'panel.index')->name('panel');
//Route::get('/panel', function () {
//    return view('panel.index');
//});
