<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoProductoController;
use App\Http\Controllers\PoblacionController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\UserController;
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
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('/logout', [LoginController::class, 'logout']);
    Route::middleware('can:admin')->group(function(){
    });

});

Route::prefix('/establecimientos')->group(function () {
    Route::get('/', [EstablecimientoController::class, 'index']);
    Route::get('/{establecimiento}', [EstablecimientoController::class, 'show']);
    Route::delete('/{establecimiento}', [EstablecimientoController::class, 'destroy']);
    Route::put('/{establecimiento}', [EstablecimientoController::class, 'update']);
    Route::post('/', [EstablecimientoController::class, 'store']);
    Route::get('/{establecimiento}/productos', [EstablecimientoController::class, 'getProductos']);
    Route::get('/{establecimiento}/categorias', [EstablecimientoController::class, 'getCategorias']);
    Route::get('/{establecimiento}/pedidos', [EstablecimientoController::class, 'getPedidos']);
    Route::get('/{establecimiento}/pedidos/pendientes', [EstablecimientoController::class, 'getPedidosPendientes']);
    Route::get('/{establecimiento}/pedidos/aceptados', [EstablecimientoController::class, 'getPedidosAceptados']);
    Route::post('/addLike', [EstablecimientoController::class, 'addLike']);
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

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::post('/', [UserController::class, 'store']);
});


Route::prefix('/pedidos')->group(function () {
    Route::get('/', [PedidoController::class, 'index']);
    Route::get('/{pedido}', [PedidoController::class, 'show']);
    Route::delete('/{pedido}', [PedidoController::class, 'destroy']);
    Route::put('/{pedido}', [PedidoController::class, 'update']);
    Route::post('/', [PedidoController::class, 'store']);
    Route::get('/mis-pedidos/{cliente}', [PedidoController::class, 'showByCliente']);

    Route::post('/aceptar/{pedido}', [EstablecimientoController::class, 'aceptarPedido']);
    Route::post('/on-the-way/{pedido}', [EstablecimientoController::class, 'setPedidoOnTheWay']);
    Route::post('/rechazar/{pedido}', [EstablecimientoController::class, 'rechazarPedido']);

    Route::post('/repartir', [RepartidorController::class, 'repartirPedido']);
    Route::get('/reparto/{id}', [RepartidorController::class, 'getPedidoEnReparto']);
    Route::post('/entregar/{pedido}', [RepartidorController::class, 'entregarPedido']);
    Route::post('/cancelar-entrega/{pedido}', [RepartidorController::class, 'cancelarPedido']);
});

Route::get('/pedido/productos', [PedidoProductoController::class, 'index']);
Route::post('/pedido/productos', [PedidoProductoController::class, 'store']);
Route::get('/pedido/{pedido}/productos', [PedidoController::class, 'getProductos']);


Route::prefix('/envios')->group(function () {
    Route::get('/', [EnvioController::class, 'index']);
    Route::get('/{envio}', [EnvioController::class, 'show']);
    Route::delete('/{envio}', [EnvioController::class, 'destroy']);
    Route::put('/{envio}', [EnvioController::class, 'update']);
    Route::post('/', [EnvioController::class, 'store']);
    Route::get('/mis-envios/{cliente}', [EnvioController::class, 'showByCliente']);

    Route::post('/repartir', [RepartidorController::class, 'repartirEnvio']);
    Route::get('/reparto/{id}', [RepartidorController::class, 'getEnviosEnReparto']);
    Route::post('/recoger/{envio}', [RepartidorController::class, 'recogerEnvio']);
    Route::post('/entregar/{envio}', [RepartidorController::class, 'entregarEnvio']);
    Route::post('/cancelar-entrega/{envio}', [RepartidorController::class, 'cancelarEnvio']);

});

Route::get('/tarjetas', [TarjetaController::class, 'index']);
Route::post('/tarjetas', [TarjetaController::class, 'store']);
Route::get('/tarjetas/{cliente}', [TarjetaController::class, 'showByCliente']);
Route::delete('/tarjetas/{tarjeta}', [TarjetaController::class, 'destroy']);//soft delete
Route::put('/tarjetas/{tarjeta}', [TarjetaController::class, 'update']);
Route::get('/tarjeta/{tarjeta}', [TarjetaController::class, 'show']);
Route::put('/tarjetas/{tarjeta}/predeterminada', [TarjetaController::class, 'setPredeterminada']);