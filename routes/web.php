<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/test-auth', function () {
        return '✅ Autenticado correctamente';
    });

    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    Route::get('/empleados', \App\Livewire\Empleados\Index::class)->name('empleados.index');
    Route::get('/empleados/create', \App\Livewire\Empleados\Create::class)->name('empleados.create');
    Route::get('/empleados/{id}/edit', \App\Livewire\Empleados\Edit::class)->name('empleados.edit');

    Route::get('/dispositivos', \App\Livewire\Dispositivos\Index::class)->name('dispositivos.index');
    Route::get('/dispositivos/create', \App\Livewire\Dispositivos\Create::class)->name('dispositivos.create');
    Route::get('/dispositivos/{id}/edit', \App\Livewire\Dispositivos\Edit::class)->name('dispositivos.edit');

    Route::get('/asignaciones', \App\Livewire\Asignaciones\Index::class)->name('asignaciones.index');
    Route::get('/asignaciones/create', \App\Livewire\Asignaciones\Create::class)->name('asignaciones.create');
});

Route::get('/prueba-ruta', function () {
    return '¡La ruta de prueba funciona!';
});

Route::get('/salir', function () {
    auth()->logout();
    return redirect('/');
})->name('logout.get');