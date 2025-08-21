<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BolsaEditResource extends JsonResource
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
            'tipo' => $this->tipo,
            'projeto_cod' => $this->projeto_cod,
            'projeto_nome' => $this->projeto_nome,
            'projeto_num' => $this->projeto_num,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'documentos' => DocumentoResource::collection($this->documentos),
        ];
    }
}
