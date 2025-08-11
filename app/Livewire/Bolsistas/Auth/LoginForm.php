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
            'cpf' => ['required'],
            'password' => ['required']
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'cpf' => 'CPF',
            'password' => 'Senha'
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
        $key = 'login:' . request()->ip();

        if (! RateLimiter::remaining($key, 5)) {
            throw ValidationException::withMessages([
                'username' => 'Muitas tentativas. Aguarde um momento e tente novamente.',
            ]);
        }

        $credentials = $this->validate();

        if ($authService->login($credentials, $this->remember)) {
            RateLimiter::clear($key);
            return $this->redirect(route('fundacao.dashboard'));
        }

        RateLimiter::hit($key);
        $this->addError('cpf', 'CPF ou senha incorretos.');
    }
    public function render()
    {
        return view('livewire.bolsistas.auth.login-form');
    }
}
