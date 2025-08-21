<?php

namespace App\Livewire\Bolsistas;

use App\Enums\BolsaTipo;
use App\Enums\DocumentoTipo;
use App\Http\Resources\BolsaPublicResource;
use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConfirmarForm extends Component
{
    use WithFileUploads;

    public array $documentos = [];

    public $bolsa = null;

    public array $documentosNecessarios;

    public string $bolsa_token = '';

    public function mount(BolsaServiceInterface $bolsaService)
    {
        $this->documentosNecessarios[] = DocumentoTipo::TERMO_LGPD;
        $this->documentosNecessarios[] = DocumentoTipo::TERMO_RACA;

        if ($bolsaService->findBolsaByToken($this->bolsa_token)->tipo == BolsaTipo::FADENOR) {
            $this->documentosNecessarios[] = DocumentoTipo::COMPROVANTE_RESIDENCIA;
            $this->documentosNecessarios[] = DocumentoTipo::DECLARACAO_ACADEMICA;
            $this->documentosNecessarios[] = DocumentoTipo::DOCUMENTO_PESSOAL;
        }

        $bolsa = new BolsaPublicResource($bolsaService->findBolsaByToken($this->bolsa_token));
        $this->bolsa = $bolsa->resolve();
    }

    protected function rules()
    {
        return [
            'documentos.'.DocumentoTipo::TERMO_LGPD->name => ['required', File::types(['pdf', 'jpg', 'png'])->max(2048)],
            'documentos.'.DocumentoTipo::TERMO_RACA->name => ['required', File::types(['pdf', 'jpg', 'png'])->max(2048)],
            'documentos.'.DocumentoTipo::COMPROVANTE_RESIDENCIA->name => [Rule::requiredIf(fn () => $this->bolsa['tipo'] == BolsaTipo::FADENOR), File::types(['pdf', 'jpg', 'png'])->max(2048)],
            'documentos.'.DocumentoTipo::DECLARACAO_ACADEMICA->name => [Rule::requiredIf(fn () => $this->bolsa['tipo'] == BolsaTipo::FADENOR), File::types(['pdf', 'jpg', 'png'])->max(2048)],
            'documentos.'.DocumentoTipo::DOCUMENTO_PESSOAL->name => [Rule::requiredIf(fn () => $this->bolsa['tipo'] == BolsaTipo::FADENOR), File::types(['pdf', 'jpg', 'png'])->max(2048)],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'documentos.'.DocumentoTipo::TERMO_LGPD->name => 'Termo de LGPD',
            'documentos.'.DocumentoTipo::TERMO_RACA->name => 'Termo de Raca',
            'documentos.'.DocumentoTipo::DOCUMENTO_PESSOAL->name => 'Documento pessoal',
            'documentos.'.DocumentoTipo::COMPROVANTE_RESIDENCIA->name => 'Comprovante de residência',
            'documentos.'.DocumentoTipo::DECLARACAO_ACADEMICA->name => 'Declaração acadêmica',
        ];
    }

    protected function messages()
    {
        return [
            'required' => 'O envio do :attribute é obrigatório.',
            'max' => 'O arquivo não deve ser maior que 2MB.',
            'enum' => 'O envio do :attribute é obrigatório.',
            'mimes' => 'O envio do :attribute deve ser um PDF, JPG ou PNG.',
            'size' => 'O :attribute tem tamanho incorreto.',
        ];
    }

    public function confirmar(BolsaServiceInterface $bolsaService)
    {
        $this->validate();
        dd($this->documentos);
        foreach ($this->documentos as $tipo => $arquivo) {
            $bolsaService->uploadDocumento($bolsaService->find($this->bolsa['id']), $tipo, $arquivo);
        }

        flash()->success('Bolsa confirmada com sucesso!');
    }

    public function render()
    {
        return view('livewire.bolsistas.confirmar-form');
    }
}
