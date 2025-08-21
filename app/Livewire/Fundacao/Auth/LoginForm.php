<?php

namespace App\Livewire\Fundacao\Auth;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LoginForm extends Component
{
    public string $username = '';

    public string $password = '';

    public bool $remember = false;

    protected function rules(): array
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'username' => 'Usuário',
            'password' => 'Senha',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
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
                RateLimiter::clear($this->throttleKey());
                return redirect()->route('fundacao.dashboard');
            }

            flash()->error('Usuário ou senha incorretos.');
            $this->addError('username', 'Usuário ou senha incorretos.');
            $this->reset();
            return redirect()->route('fundacao.login');
        }, $decay);

        if ($result === false) {
            $seconds = RateLimiter::availableIn($key);
            $this->resetErrorBag();
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            return;
        }
    }

    private function throttleKey(): string
    {
        return 'login-fundacao:' . request()->ip();
    }

    public function render()
    {
        return view('livewire.fundacao.auth.login-form');
    }
}
