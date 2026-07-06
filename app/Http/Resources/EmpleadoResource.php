<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'nombre_completo' => $this->primer_nombre . ' ' . $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'identificacion' => $this->identificacion,
            'departamento' => new DepartamentoResource($this->whenLoaded('departamento')),
            'asignaciones' => AsignacionResource::collection($this->whenLoaded('asignaciones')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
