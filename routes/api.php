<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\DispositivoController;
use App\Http\Controllers\Api\AsignacionController;

Route::middleware('auth:sanctum')->group(function () {
    // EMPLEADOS - CRUD completo
    Route::get('empleados', [EmpleadoController::class, 'index']);
    Route::get('empleados/{id}', [EmpleadoController::class, 'show']);
    Route::post('empleados', [EmpleadoController::class, 'store']);
    Route::put('empleados/{id}', [EmpleadoController::class, 'update']);
    Route::delete('empleados/{id}', [EmpleadoController::class, 'destroy']);

    // DISPOSITIVOS - CRUD completo
    Route::get('dispositivos', [DispositivoController::class, 'index']);
    Route::get('dispositivos/{id}', [DispositivoController::class, 'show']);
    Route::post('dispositivos', [DispositivoController::class, 'store']);
    Route::put('dispositivos/{id}', [DispositivoController::class, 'update']);
    Route::delete('dispositivos/{id}', [DispositivoController::class, 'destroy']);

    // ASIGNACIONES - CRUD completo
    Route::get('asignaciones', [AsignacionController::class, 'index']);
    Route::get('asignaciones/{id}', [AsignacionController::class, 'show']);
    Route::post('asignaciones', [AsignacionController::class, 'store']);
    Route::put('asignaciones/{id}', [AsignacionController::class, 'update']);
    Route::delete('asignaciones/{id}', [AsignacionController::class, 'destroy']);

    // Usuario autenticado
    Route::get('user', function () {
        return request()->user();
    });
});