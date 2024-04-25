<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth'])->group(function(){


    Route::middleware('can:admin')->group(function(){
    });

});



Route::prefix('/productos')->group(function () {
    Route::get('/', [ProductoController::class, 'index']);
    Route::get('/{producto}', [ProductoController::class, 'show']);
    Route::delete('/{producto}', [ProductoController::class, 'destroy']);
    Route::put('/{producto}', [ProductoController::class, 'update']);
    Route::post('/', [ProductoController::class, 'store']);
});

Route::prefix('/categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index']);
    // Route::get('/{categoria}', [CategoriaController::class, 'show']);
    // Route::delete('/{categoria}', [CategoriaController::class, 'destroy']);
    // Route::post('/{categoria}', [CategoriaController::class, 'update']);
    // Route::post('/', [CategoriaController::class, 'store']);
});

Route::prefix('/establecimientos')->group(function () {
    Route::get('/', [EstablecimientoController::class, 'index']);
    Route::get('/{establecimiento}', [EstablecimientoController::class, 'show']);
    Route::delete('/{establecimiento}', [EstablecimientoController::class, 'destroy']);
    Route::put('/{establecimiento}', [EstablecimientoController::class, 'update']);
    Route::post('/', [EstablecimientoController::class, 'store']);
});

Route::prefix('/pedidos')->group(function () {
    Route::get('/', [PedidoController::class, 'index']);
    Route::get('/{pedido}', [PedidoController::class, 'show']);
    Route::delete('/{pedido}', [PedidoController::class, 'destroy']);
    Route::post('/{pedido}', [PedidoController::class, 'update']);
    Route::post('/', [PedidoController::class, 'store']);
});
