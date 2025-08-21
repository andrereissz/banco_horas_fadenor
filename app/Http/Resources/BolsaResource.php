<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BolsaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'solicitante' => $this->user->name,
            'status' => $this->status,
            'projeto_cod' => $this->projeto_cod,
            'projeto_nome' => $this->projeto_nome,
            'projeto_num' => $this->projeto_num,
            'projeto_tipo' => $this->projeto_tipo,
            'data_inicio' => $this->data_inicio,
            'documentos' => DocumentoResource::collection($this->documentos),
        ];
    }
}
