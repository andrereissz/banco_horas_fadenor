<?php

namespace App\Livewire\Bolsistas;

use App\Enums\BolsaEscolaridade;
use App\Enums\BolsaEstadoCivil;
use App\Enums\BolsaRacaCor;
use App\Services\Interfaces\ViaCep\ViaCepServiceInterface;
use Livewire\Component;

class CadastroForm extends Component
{
    public string $nome;
    public string $dataNasc;
    public string $nomeMae;
    public string $nomePai;
    public string $sexo;
    public string $telefone;
    public string $email;
    public string $estPais;
    public string $estMuni;
    public string $muniNasc;
    public string $ufNasc;
    public string $cep;
    public string $muniResid;
    public string $ufResid;
    public string $logradouro;
    public string $numero;
    public string $complemento;
    public string $bairro;
    public string $cpf;
    public string $pis;
    public string $rg;
    public string $rgOrgao;
    public string $rgOrgaoUf;
    public string $rgDataEmissao;
    public string $tituloEleitor;
    public string $tituloZona;
    public string $tituloSecao;
    public string $certificadoReservista;
    public string $password;

    public int $escolaridade;
    public int $estadoCivil;
    public int $flag_estrangeiro = 0;
    public int $racaCor;

    protected function rules(): array
    {
        return [
            'nome'                   => ['required', 'string', 'min:3', 'max:255'],
            'dataNasc'              => ['required', 'date'], // se usar <input type="date">, o formato já é aceito
            'nomeMae'               => ['required', 'string', 'max:255'],
            'nomePai'               => ['nullable', 'string', 'max:255'],

            'sexo'                   => ['required', 'in:M,F,O'], // M/F/Outro (ajuste conforme sua regra)
            'telefone'               => ['required', 'string', 'regex:/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/'],
            'email'                  => ['required', 'email:rfc,dns', 'max:255'],

            'estPais'               => ['required', 'string', 'max:255'],
            'estMuni'               => ['required', 'string', 'max:255'],

            'muniNasc'              => ['required', 'string', 'max:255'],
            'ufNasc'                => ['required', 'string', 'size:2'],

            'cep'                    => ['required', 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'muniResid'             => ['required', 'string', 'max:255'],
            'ufResid'               => ['required', 'string', 'size:2'],
            'logradouro'             => ['required', 'string', 'max:255'],
            'numero'                 => ['required', 'string', 'max:20'], // pode conter complemento tipo "12A"
            'complemento'            => ['nullable', 'string', 'max:255'],
            'bairro'                 => ['required', 'string', 'max:255'],

            'cpf'                    => ['required', 'string', 'digits:11'], // se tiver validador próprio, troque por 'cpf'
            'pis'                    => ['nullable', 'string', 'digits_between:10,14'],

            'rg'                     => ['required', 'string', 'max:20'],
            'rgOrgao'               => ['required', 'string', 'max:50'],
            'rgOrgaoUf'            => ['required', 'string', 'size:2'],
            'rgDataEmissao'        => ['required', 'date'],

            'tituloEleitor'         => ['nullable', 'string', 'max:14'],
            'tituloZona'            => ['nullable', 'string', 'max:4'],
            'tituloSecao'           => ['nullable', 'string', 'max:4'],

            'certificadoReservista' => ['nullable', 'string', 'max:30'],

            'password'               => ['required', 'string', 'min:8'],

            'escolaridade'           => ['required', 'integer'],
            'estadoCivil'           => ['required', 'integer'],
            'racaCor'               => ['required', 'integer'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'nome'                   => 'Nome completo',
            'dataNasc'              => 'Data de nascimento',
            'nomeMae'               => 'Nome da mãe',
            'nomePai'               => 'Nome do pai',
            'sexo'                   => 'Sexo',
            'telefone'               => 'Telefone',
            'email'                  => 'E-mail',
            'estPais'               => 'País de estudo',
            'estMuni'               => 'Município de estudo',
            'muniNasc'              => 'Município de nascimento',
            'ufNasc'                => 'UF de nascimento',
            'cep'                    => 'CEP',
            'muniResid'             => 'Município de residência',
            'ufResid'               => 'UF de residência',
            'logradouro'             => 'Logradouro',
            'numero'                 => 'Número',
            'complemento'            => 'Complemento',
            'bairro'                 => 'Bairro',
            'cpf'                    => 'CPF',
            'pis'                    => 'PIS',
            'rg'                     => 'RG',
            'rgOrgao'               => 'Órgão expedidor (RG)',
            'rgOrgaoUf'            => 'UF do órgão expedidor (RG)',
            'rgDataEmissao'        => 'Data de emissão (RG)',
            'tituloEleitor'         => 'Título de eleitor',
            'tituloZona'            => 'Zona eleitoral',
            'tituloSecao'           => 'Seção eleitoral',
            'certificadoReservista' => 'Certificado de reservista',
            'password'               => 'Senha',
            'escolaridade'           => 'Escolaridade',
            'estadoCivil'           => 'Estado civil',
            'racaCor'               => 'Raça/cor',
        ];
    }

    protected function messages(): array
    {
        return [
            'required'   => 'O campo :attribute é obrigatório.',
            'string'     => 'O campo :attribute deve ser um texto.',
            'min'        => [
                'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            ],
            'max'        => [
                'string' => 'O campo :attribute pode ter no máximo :max caracteres.',
            ],
            'email'      => 'Informe um :attribute válido.',
            'date'       => 'O campo :attribute deve ser uma data válida.',
            'integer'    => 'O campo :attribute deve ser um número inteiro.',
            'in'         => 'O valor selecionado para :attribute é inválido.',
            'size'       => [
                'string' => 'O campo :attribute deve ter exatamente :size caracteres.',
            ],
            'digits'     => 'O campo :attribute deve conter exatamente :digits dígitos.',
            'digits_between' => 'O campo :attribute deve conter entre :min e :max dígitos.',
            'regex'      => 'O formato de :attribute é inválido.',
        ];
    }

    public function buscarCep(ViacepServiceInterface $viacep): void
    {
        $digits = preg_replace('/[^0-9]/', '', $this->cep);
        if (strlen($digits) !== 8) {
            $this->addError('cep', 'Informe um CEP válido (8 dígitos).');
            return;
        }

        $data = $viacep->buscar($digits);

        if (! $data) {
            $this->addError('cep', 'CEP não encontrado ou indisponível.');
            return;
        }

        $this->cep         = $data['cep'];
        $this->logradouro  = $data['logradouro'];
        $this->bairro      = $data['bairro'];
        $this->muniResid  = $data['localidade'];
        $this->ufResid    = $data['uf'];
        $this->complemento = $data['complemento'];

        $this->resetErrorBag('cep');
    }

    public function render()
    {
        return view('livewire.bolsistas.cadastro-form');
    }
}
