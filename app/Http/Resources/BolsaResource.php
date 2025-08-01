<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BolsaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dados = [
            'id' => $this->id,
            'solicitante' => $this->user->name,
            'nome' => $this->nome,
            'email' => $this->email,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'documentos' => DocumentoResource::collection($this->documentos),
        ];

        if ($request->routeIs('bolsistas.edit') || $request->routeIs('bolsistas.export')) {
            $dados = array_merge($dados, [
                'data_nasc' => $this->data_nasc,
                'nome_mae' => $this->nome_mae,
                'nome_pai' => $this->nome_pai,
                'estado_civil' => $this->estado_civil,
                'raca_cor' => $this->raca_cor,
                'telefone' => $this->telefone,
                'escolaridade' => $this->escolaridade,
                'muni_nasc' => $this->muni_nasc,
                'uf_nasc' => $this->uf_nasc,
                'cep' => $this->cep,
                'muni_resid' => $this->muni_resid,
                'uf_resid' => $this->uf_resid,
                'logradouro' => $this->logradouro,
                'numero' => $this->numero,
                'complemento' => $this->complemento,
                'bairro' => $this->bairro,
                'cpf' => $this->cpf,
                'pis' => $this->pis,
                'titulo_eleitor' => $this->titulo_eleitor,
                'titulo_zona' => $this->titulo_zona,
                'titulo_secao' => $this->titulo_secao,
                'rg' => $this->rg,
                'rg_orgao' => $this->rg_orgao,
                'rg_orgao_uf' => $this->rg_orgao_uf,
                'rg_data_emissao' => $this->rg_data_emissao,
                'certificado_reservista' => $this->certificado_reservista,
                'agencia' => $this->agencia,
                'conta' => $this->conta,
            ]);
        }

        return $dados;
    }
}
