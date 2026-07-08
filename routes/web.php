<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    // Mi dispositivo (usuario regular)
    Route::get('/mi-dispositivo', \App\Livewire\MiDispositivo::class)->name('mi-dispositivo');

    // Admin — usuarios
    Route::get('/usuarios', \App\Livewire\Usuarios\Index::class)->name('usuarios.index')->middleware('role:admin');
    Route::get('/admin/register-user', \App\Livewire\Admin\RegisterUser::class)
        ->middleware('role:admin')
        ->name('admin.register-user');

    // CRUD Departamentos (admin)
    Route::get('/departamentos', \App\Livewire\Departamentos\Index::class)->name('departamentos.index')->middleware('role:admin');
    Route::get('/departamentos/create', \App\Livewire\Departamentos\Create::class)->name('departamentos.create')->middleware('role:admin');
    Route::get('/departamentos/{id}/edit', \App\Livewire\Departamentos\Edit::class)->name('departamentos.edit')->middleware('role:admin');

    // CRUD Empleados (admin)
    Route::get('/empleados', \App\Livewire\Empleados\Index::class)->name('empleados.index')->middleware('role:admin');
    Route::get('/empleados/create', \App\Livewire\Empleados\Create::class)->name('empleados.create')->middleware('role:admin');
    Route::get('/empleados/{id}/edit', \App\Livewire\Empleados\Edit::class)->name('empleados.edit')->middleware('role:admin');
    Route::get('/empleados/{id}', \App\Livewire\Empleados\Show::class)->name('empleados.show')->middleware('role:admin');

    // CRUD Dispositivos (admin)
    Route::get('/dispositivos', \App\Livewire\Dispositivos\Index::class)->name('dispositivos.index')->middleware('role:admin');
    Route::get('/dispositivos/create', \App\Livewire\Dispositivos\Create::class)->name('dispositivos.create')->middleware('role:admin');
    Route::get('/dispositivos/{id}/edit', \App\Livewire\Dispositivos\Edit::class)->name('dispositivos.edit')->middleware('role:admin');
    Route::get('/dispositivos/{id}', \App\Livewire\Dispositivos\Show::class)->name('dispositivos.show')->middleware('role:admin');

    // CRUD Asignaciones (admin)
    Route::get('/asignaciones', \App\Livewire\Asignaciones\Index::class)->name('asignaciones.index')->middleware('role:admin');
    Route::get('/asignaciones/create', \App\Livewire\Asignaciones\Create::class)->name('asignaciones.create')->middleware('role:admin');
});
