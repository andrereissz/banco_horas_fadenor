<?php

namespace App\Livewire\Bolsistas\Auth;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LoginForm extends Component
{
    public string $cpf = '';

    public string $password = '';

    public bool $remember = false;

    protected function rules(): array
    {
        return [
            'cpf' => ['required', 'string', 'size:14'],
            'password' => ['required'],
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

        public function authenticate(AuthServiceInterface $authService)
    {
        $key         = $this->throttleKey();
        $maxAttempts = 5;     // máximo de tentativas
        $decay       = 60;    // janela (em segundos)

        $result = RateLimiter::attempt($key, $maxAttempts, function () use ($authService) {
            $credentials = $this->validate();
            if ($authService->login($credentials, $this->remember)) {
                $token  = session()->pull('bolsa_token');
                RateLimiter::clear($this->throttleKey());

                if($token) {
                    return redirect()->route('bolsistas.confirmar', ['bolsa_token' => $token]);
                }
                flash()->success('Login realizado com sucesso.');
                return redirect()->route('bolsistas.login');
            }

            flash()->error('CPF ou senha incorretos.');
            $this->addError('cpf', 'CPF ou senha incorretos.');
            $this->reset();
            return redirect()->route('bolsistas.login');
        }, $decay);

        if ($result === false) {
            $seconds = RateLimiter::availableIn($key);
            $this->resetErrorBag();
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            $this->reset();
            return;
        }
    }

    private function throttleKey(): string
    {
        return 'login-fundacao:'.request()->ip();
    }


    public function render()
    {
        return view('livewire.bolsistas.auth.login-form');
    }
}
