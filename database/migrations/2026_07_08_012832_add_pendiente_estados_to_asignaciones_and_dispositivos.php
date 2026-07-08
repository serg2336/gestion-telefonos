<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE asignaciones MODIFY COLUMN estado ENUM('activo', 'devuelto', 'pendiente_devolver') NOT NULL DEFAULT 'activo'");
            DB::statement("ALTER TABLE dispositivos MODIFY COLUMN estado ENUM('disponible', 'asignado', 'mantenimiento', 'baja', 'bloqueado') NOT NULL DEFAULT 'disponible'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE asignaciones MODIFY COLUMN estado ENUM('activo', 'devuelto') NOT NULL DEFAULT 'activo'");
            DB::statement("ALTER TABLE dispositivos MODIFY COLUMN estado ENUM('disponible', 'asignado', 'mantenimiento', 'baja') NOT NULL DEFAULT 'disponible'");
        }
    }
};
