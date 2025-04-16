<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Almacenar ordenes
    Route::apiResource('/pedidos', PedidoController::class );
    Route::get('/pedidos/estado/{estadoId}', [PedidoController::class, 'pedidosPorEstado']);
    Route::put('/pedidos/update-pay/{pedido}', [PedidoController::class, 'updatePay']);

});

Route::apiResource('/categorias', CategoriaController::class);
Route::apiResource('/productos', ProductoController::class);
Route::get('/productos/categoria/{categoriaId}', [ProductoController::class, 'productosPorCategoria']);
Route::get('/detalle/{productoId}', [ProductoController::class, 'DetalleProducto']);

// Autenticacion
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Ruta Monedas y billetes
Route::get('/monedas', [CoinController::class, 'index']);