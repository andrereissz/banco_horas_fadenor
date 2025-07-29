<?php

namespace App\Livewire\Bolsa;

use App\Services\BolsaService;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class SolicitarBolsaForm extends Component
{
    use WithFileUploads;

    public int $tipo = 0;
    public string $projetoCod = '';
    public string $projetoNome = '';
    public string $projetoNum = '';
    public string $emailCoordenador = '';
    public string $nome = '';
    public string $valor = '';
    public string $dataInicio = '';
    public string $dataFim = '';
    public ?UploadedFile $docLgpd = null;
    public ?UploadedFile $docTermoBolsa = null;

    protected function rules(): array
    {
        return [
            'tipo' => ['required', 'integer', Rule::in([0, 1])],
            'projetoCod' => 'required',
            'projetoNome' => 'required',
            'projetoNum' => 'required',
            'emailCoordenador' => 'required|email',
            'nome' => 'required',
            'valor' => 'required|numeric',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after:dataInicio',
            'docTermoBolsa' => 'required|file|mimes:pdf|max:5120'
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'projetoCod' => 'Código do Projeto',
            'projetoNome' => 'Nome do Projeto',
            'projetoNum' => 'Número do Projeto',
            'emailCoordenador' => 'Email do Coordenador',
            'nome' => 'Nome do Bolsista',
            'valor' => 'Valor da Bolsa',
            'dataInicio' => 'Data de Início',
            'dataFim' => 'Data de Fim',
            'docTermoBolsa' => 'Termo de Bolsa'
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'after:dataInicio' => 'A data de fim deve ser posterior à data de início.'
        ];
    }

    public function solicitarBolsa(BolsaService $bolsaService)
    {
        try {
            $validatedData = $this->validate();

            $bolsaService->solicitar($validatedData, [
                $this->docLgpd,
                $this->docTermoBolsa
            ]);

            flash()->success('Bolsa solicitada com sucesso!');

            $this->redirect(route('bolsas.index'));

        } catch (\Exception $e) {
            flash()->error('Ocorreu um erro inesperado: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bolsas.solicitar-bolsa-form');
    }
}
