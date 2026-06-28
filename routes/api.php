<?php

use Illuminate\Support\Facades\Route; // <-- Esta es la línea que falta

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\DetallePedidoController;
use App\Http\Controllers\Api\PerfilController;

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('marcas', MarcaController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('detalle-pedidos', DetallePedidoController::class);
Route::apiResource('perfiles', PerfilController::class);