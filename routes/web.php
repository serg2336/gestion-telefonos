<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // CRUD Departamentos
    Route::get('/departamentos', \App\Livewire\Departamentos\Index::class)->name('departamentos.index');
    Route::get('/departamentos/create', \App\Livewire\Departamentos\Create::class)->name('departamentos.create');
    Route::get('/departamentos/{id}/edit', \App\Livewire\Departamentos\Edit::class)->name('departamentos.edit');

    // Ruta de prueba
    Route::get('/test-auth', function () {
        return '✅ Autenticado correctamente';
    });

    // Dashboard
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    // CRUD Empleados
    Route::get('/empleados', \App\Livewire\Empleados\Index::class)->name('empleados.index');
    Route::get('/empleados/create', \App\Livewire\Empleados\Create::class)->name('empleados.create');
    Route::get('/empleados/{id}/edit', \App\Livewire\Empleados\Edit::class)->name('empleados.edit');
feature/historial-asignaciones
    Route::get('/empleados/{id}', \App\Livewire\Empleados\Show::class)->name('empleados.show');

    Route::get('/dispositivos/{id}', \App\Livewire\Dispositivos\Show::class)->name('dispositivos.show');

 develop
});

Route::get('/prueba-ruta', function () {
    return '¡La ruta de prueba funciona!';
});

Route::get('/salir', function () {
    Auth::logout();
    return redirect('/');
})->name('logout.get');