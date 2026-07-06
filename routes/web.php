<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Ruta de prueba
    Route::get('/test-auth', function () {
        return '✅ Autenticado correctamente';
    });

    // Dashboard
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    // CRUD Departamentos
    Route::get('/departamentos', \App\Livewire\Departamentos\Index::class)->name('departamentos.index');
    Route::get('/departamentos/create', \App\Livewire\Departamentos\Create::class)->name('departamentos.create');
    Route::get('/departamentos/{id}/edit', \App\Livewire\Departamentos\Edit::class)->name('departamentos.edit');

    // CRUD Empleados
    Route::get('/empleados', \App\Livewire\Empleados\Index::class)->name('empleados.index');
    Route::get('/empleados/create', \App\Livewire\Empleados\Create::class)->name('empleados.create');
    Route::get('/empleados/{id}/edit', \App\Livewire\Empleados\Edit::class)->name('empleados.edit');
    Route::get('/empleados/{id}', \App\Livewire\Empleados\Show::class)->name('empleados.show');

    // CRUD Dispositivos
    Route::get('/dispositivos', \App\Livewire\Dispositivos\Index::class)->name('dispositivos.index');
    Route::get('/dispositivos/create', \App\Livewire\Dispositivos\Create::class)->name('dispositivos.create');
    Route::get('/dispositivos/{id}/edit', \App\Livewire\Dispositivos\Edit::class)->name('dispositivos.edit');
    Route::get('/dispositivos/{id}', \App\Livewire\Dispositivos\Show::class)->name('dispositivos.show');

    // CRUD Asignaciones
    Route::get('/asignaciones', \App\Livewire\Asignaciones\Index::class)->name('asignaciones.index');
    Route::get('/asignaciones/create', \App\Livewire\Asignaciones\Create::class)->name('asignaciones.create');
});

// Rutas públicas
Route::get('/prueba-ruta', function () {
    return '¡La ruta de prueba funciona!';
});

Route::get('/salir', function () {
    Auth::logout();
    return redirect('/');
})->name('logout.get');