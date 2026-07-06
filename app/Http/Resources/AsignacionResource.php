<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AsignacionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dispositivo' => new DispositivoResource($this->whenLoaded('dispositivo')),
            'empleado' => new EmpleadoResource($this->whenLoaded('empleado')),
            'fecha_asignacion' => $this->fecha_asignacion,
            'fecha_devolucion' => $this->fecha_devolucion,
            'estado' => $this->estado,
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
