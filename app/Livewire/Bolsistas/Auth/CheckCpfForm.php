<?php

namespace App\Livewire\Bolsistas\Auth;

use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckCpfForm extends Component
{
    public $bolsa_token;

    public string $cpf = '';
    public int $step = 1;

    protected function rules(): array
    {
        return [
            'cpf' => ['required', 'string', 'size:14'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'cpf' => 'CPF',
            'password' => 'Senha',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'size' => 'O campo :attribute tem tamanho incorreto.',
        ];
    }

    public function mount(?string $bolsa_token = null)
    {
        $this->bolsa_token = $bolsa_token ?? request()->route('bolsa_token');
    }

    public function checkCpf(BolsistaServiceInterface $bolsistaService)
    {
        $result = RateLimiter::attempt($this->throttleKey(), 5, function () use ($bolsistaService) {
            $this->validate();
            if (!$this->validarCPF($this->cpf)) {
                flash()->error('CPF inválido');
                return redirect()->route('bolsistas.registrar', ['bolsa_token' => $this->bolsa_token]);
            }
            if ($bolsistaService->find($this->cpf) !== null) {
                RateLimiter::clear($this->throttleKey());
                session(['bolsa_token' => $this->bolsa_token]);
                return redirect()->route('bolsistas.login',);
            };

            RateLimiter::clear($this->throttleKey());
            return redirect()->route('bolsistas.cadastrar', ['bolsa_token' => $this->bolsa_token]);
        });

        if ($result === false) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            return;
        }
    }

    function validarCPF(string $cpf): bool
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);

        // Verifica se tem 11 dígitos e não é uma sequência repetida
        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        // Validação dos dois dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += $cpf[$i] * (($t + 1) - $i);
            }
            $digito = ((10 * $soma) % 11) % 10;
            if ($cpf[$t] != $digito) {
                return false;
            }
        }

        return true;
    }

    public function throttleKey(): string
    {
        return 'check-cpf:' . request()->ip();
    }


    public function render()
    {
        return view('livewire.bolsistas.auth.check-cpf-form');
    }
}
