<?php

namespace App\Livewire\Bolsistas;

use App\Enums\BolsaEscolaridade;
use App\Enums\BolsaEstadoCivil;
use App\Enums\BolsaRacaCor;
use App\Enums\BolsaStatus;
use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
use App\Services\Interfaces\ViaCep\ViaCepServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CadastroForm extends Component
{
    public string $nome = '';
    public string $dataNasc = '';
    public string $nomeMae = '';
    public string $nomePai = '';
    public string $sexo = '';
    public string $telefone = '';
    public string $email = '';
    public string $estPais = '';
    public string $estMuni = '';
    public string $muniNasc = '';
    public string $ufNasc = '';
    public string $cep = '';
    public string $muniResid = '';
    public string $ufResid = '';
    public string $logradouro = '';
    public string $numero = '';
    public string $complemento = '';
    public string $bairro = '';
    public string $cpf = '';
    public string $pis = '';
    public string $rg = '';
    public string $rgOrgao = '';
    public string $rgOrgaoUf = '';
    public string $rgDataEmissao = '';
    public string $tituloEleitor = '';
    public string $tituloZona = '';
    public string $tituloSecao = '';
    public string $certificadoReservista = '';
    public string $password = '';
    public string $password_confirmation = '';

    public int $escolaridade = 0;
    public int $estadoCivil = 0;
    public int $flag_estrangeiro = 0;
    public int $racaCor = 0;

    public string $bolsa_token = '';

    protected function rules(): array
    {
        return [
            'nome'                   => ['required', 'string', 'min:3', 'max:255'],
            'dataNasc'              => ['required', 'date'], // se usar <input type="date">, o formato já é aceito
            'nomeMae'               => ['required', 'string', 'max:255'],
            'nomePai'               => ['nullable', 'string', 'max:255'],

            'telefone'               => ['required', 'string', 'min:14', 'max:15'],
            'email'                  => ['required', 'email:rfc,dns', 'max:255'],

            'estPais'               => [Rule::requiredIf(fn() => $this->flag_estrangeiro == 1)],

            'muniNasc'              => ['required', 'string', 'max:255'],
            'ufNasc'                => [Rule::requiredIf(fn() => $this->flag_estrangeiro == 0)],

            'cep'                    => ['required', 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'muniResid'             => ['required', 'string', 'max:255'],
            'ufResid'               => ['required', 'string', 'size:2'],
            'logradouro'             => ['required', 'string', 'max:255'],
            'numero'                 => ['required', 'string', 'max:20'], // pode conter complemento tipo "12A"
            'complemento'            => ['nullable', 'string', 'max:255'],
            'bairro'                 => ['required', 'string', 'max:255'],

            'cpf'                    => ['required', 'string', 'size:14'],
            'pis'                    => ['nullable', 'string' , 'size:11'],

            'rg'                     => ['required', 'string', 'max:20'],
            'rgOrgao'               => ['required', 'string', 'max:50'],
            'rgOrgaoUf'            => ['required', 'string', 'size:2'],
            'rgDataEmissao'        => ['required', 'date'],

            'tituloEleitor'         => ['nullable', 'string', 'max:14'],
            'tituloZona'            => ['nullable', 'string', 'max:3'],
            'tituloSecao'           => ['nullable', 'string', 'max:4'],

            'certificadoReservista' => ['nullable', 'string', 'max:30'],

            'password'               => ['required', 'string', 'min:8', 'confirmed'],

            'sexo'                   => ['required', 'in:M,F,O'],
            'escolaridade'           => ['required', 'integer', Rule::enum(BolsaEscolaridade::class)],
            'estadoCivil'           => ['required', 'integer', Rule::enum(BolsaEstadoCivil::class)],
            'racaCor'               => ['required', 'integer', Rule::enum(BolsaRacaCor::class)],
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

    public function registrar(BolsistaServiceInterface $bolsistaService, BolsaServiceInterface $bolsaService)
    {
        $data = $this->validate();
        $result = RateLimiter::attempt($this->throttleKey(), 5, function () use ($bolsistaService, $bolsaService, $data) {
            if ($bolsistaService->create($data) != null) {
                RateLimiter::clear($this->throttleKey());
                flash()->success('Cadastro registrado com sucesso.');
                $bolsaService->updateStatus($bolsaService->findBolsaByToken($this->bolsa_token), BolsaStatus::Respondido);
                return redirect()->route('bolsistas.login');
            };

            flash()->error('Erro ao registrar bolsista.');
        }, 60);

        if ($result === false) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            return;
        }
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

    public function throttleKey(): string
    {
        return 'cadastro-bolsistas:' . request()->ip();
    }

    public function mount(string $bolsa_token): void
    {
        $this->bolsa_token = $bolsa_token;
    }

    public function render()
    {
        return view('livewire.bolsistas.cadastro-form');
    }
}
