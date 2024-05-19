<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoProductoController;
use App\Http\Controllers\PoblacionController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function (Request $request) {
    if(Auth::check()){
        return $request->user();
    }
    return 'no estas logueado';
});


Route::middleware(['auth'])->group(function(){

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('/tarjetas', [TarjetaController::class, 'store']);
    Route::get('/tarjetas', [TarjetaController::class, 'showByCliente']);


    Route::middleware('can:admin')->group(function(){
    });

});

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::prefix('/productos')->group(function () {
    Route::get('/', [ProductoController::class, 'index']);
    Route::get('/{producto}', [ProductoController::class, 'show']);
    Route::delete('/{producto}', [ProductoController::class, 'destroy']);
    Route::put('/{producto}', [ProductoController::class, 'update']);
    Route::post('/', [ProductoController::class, 'store']);
});

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);

Route::get('/poblaciones', [PoblacionController::class, 'index']);
Route::get('/poblaciones/{poblacion}', [PoblacionController::class, 'show']);


Route::prefix('/establecimientos')->group(function () {
    Route::get('/', [EstablecimientoController::class, 'index']);
    Route::get('/{establecimiento}', [EstablecimientoController::class, 'show']);
    Route::delete('/{establecimiento}', [EstablecimientoController::class, 'destroy']);
    Route::put('/{establecimiento}', [EstablecimientoController::class, 'update']);
    Route::post('/', [EstablecimientoController::class, 'store']);
    Route::get('/{establecimiento}/productos', [EstablecimientoController::class, 'getProductos']);
});

Route::prefix('/pedidos')->group(function () {
    Route::get('/', [PedidoController::class, 'index']);
    Route::get('/{pedido}', [PedidoController::class, 'show']);
    Route::delete('/{pedido}', [PedidoController::class, 'destroy']);
    Route::put('/{pedido}', [PedidoController::class, 'update']);
    Route::post('/', [PedidoController::class, 'store']);
    Route::get('/mis-pedidos/{cliente}', [PedidoController::class, 'showByCliente']);

});

Route::get('/pedido/productos', [PedidoProductoController::class, 'index']);
Route::post('/pedido/productos', [PedidoProductoController::class, 'store']);
Route::get('/pedido/{pedido}/productos', [PedidoController::class, 'getProductos']);


