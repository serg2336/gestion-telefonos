<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {
             $table->id();
             $table->foreignId('dispositivo_id')->constrained('dispositivos')->onDelete('restrict');
            $table->foreignId('empleado_id')->constrained('empleados')->onDelete('restrict');
            $table->timestamp('fecha_asignacion')->useCurrent();
             $table->timestamp('fecha_devolucion')->nullable();
            $table->enum('estado', ['activo', 'devuelto', 'pendiente_devolver'])->default('activo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacions');
    }
};
