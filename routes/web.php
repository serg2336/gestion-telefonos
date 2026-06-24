<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::get('/register', function () {
    return view('livewire.pages.auth.register');
     })->middleware('guest');



require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
      Route::get('/test-auth', function () {
        return '✅ Autenticado correctamente';
    });

    
    Route::get('/empleados', \App\Livewire\Empleados\Index::class)->name('empleados.index');
    Route::get('/empleados/create', \App\Livewire\Empleados\Create::class)->name('empleados.create');
    Route::get('/empleados/{id}/edit', \App\Livewire\Empleados\Edit::class)->name('empleados.edit');
    
});
Route::get('/prueba-ruta', function () {
    return '¡La ruta de prueba funciona!';
});
