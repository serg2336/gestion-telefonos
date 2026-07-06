<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\DispositivoController;
use App\Http\Controllers\Api\AsignacionController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('empleados', [EmpleadoController::class, 'index']);
    Route::get('empleados/{id}', [EmpleadoController::class, 'show']);

    Route::get('dispositivos', [DispositivoController::class, 'index']);
    Route::get('dispositivos/{id}', [DispositivoController::class, 'show']);

    Route::get('asignaciones', [AsignacionController::class, 'index']);
    Route::get('asignaciones/{id}', [AsignacionController::class, 'show']);

    Route::get('user', function () {
        return request()->user();
    });
});
