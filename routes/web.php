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

    
});

Route::get('/prueba-ruta', function () {
    return '¡La ruta de prueba funciona!';
});

Route::get('/salir', function () {
    auth()->logout();
    return redirect('/');
})->name('logout.get');