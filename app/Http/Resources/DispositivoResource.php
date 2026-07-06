<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DispositivoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'numero_serie' => $this->numero_serie,
            'imei' => $this->imei,
            'estado' => $this->estado,
            'fecha_compra' => $this->fecha_compra,
            'observaciones' => $this->observaciones,
            'asignacion_actual' => new AsignacionResource($this->whenLoaded('asignacionActiva')),
            'asignaciones' => AsignacionResource::collection($this->whenLoaded('asignaciones')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
