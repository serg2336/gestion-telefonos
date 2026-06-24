<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Livewire\Livewire;
use App\Livewire\Empleados\Index;
use App\Livewire\Empleados\Create;
use App\Livewire\Empleados\Edit;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    //Livewire::component('empleados.index', Index::class);
    //Livewire::component('empleados.create', Create::class);
    //Livewire::component('empleados.edit', Edit::class);
 //
    }
}
