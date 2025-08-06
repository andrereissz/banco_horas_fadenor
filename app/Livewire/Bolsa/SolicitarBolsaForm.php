<?php

namespace App\Livewire\Bolsa;

use App\Enums\BolsaTipo;
use App\Models\Bolsa;
use App\Services\BolsaService;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class SolicitarBolsaForm extends Component
{
    use WithFileUploads;

    public int $tipo = BolsaTipo::FADENOR->value;

    public string $projetoCod = '';

    public string $projetoNome = '';

    public string $projetoNum = '';

    public string $emailDestinatario = '';

    public string $nome = '';

    public string $valor = '';

    public string $dataInicio = '';

    public string $dataFim = '';

    protected function rules(): array
    {
        return [
            'tipo' => ['required', 'integer', Rule::enum(BolsaTipo::class)],
            'projetoCod' => 'required',
            'projetoNome' => 'required',
            'projetoNum' => [Rule::requiredIf(fn () => $this->tipo == BolsaTipo::FAPEMIG->value)],
            'emailDestinatario' => 'required|email',
            'nome' => 'required',
            'valor' => 'required|numeric',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after:dataInicio',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'projetoCod' => 'Código do Projeto',
            'projetoNome' => 'Nome do Projeto',
            'projetoNum' => 'Número do Projeto',
            'emailDestinatario' => 'Email do Destinatário',
            'nome' => 'Nome do Bolsista',
            'valor' => 'Valor da Bolsa',
            'dataInicio' => 'Data de Início',
            'dataFim' => 'Data de Fim',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'after:dataInicio' => 'A data de fim deve ser posterior à data de início.',
        ];
    }

    public function solicitarBolsa(BolsaService $bolsaService)
    {
        try {
            $validatedData = $this->validate();

            $bolsaService->solicitar($validatedData);

            flash()->success('Bolsa solicitada com sucesso!');

            $this->redirect(route('fundacao.solicitar-bolsa'));

        } catch (\Exception $e) {
            flash()->error($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bolsa.solicitar-bolsa-form');
    }
}
