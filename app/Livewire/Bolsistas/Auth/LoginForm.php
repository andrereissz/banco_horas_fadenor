<?php

namespace App\Livewire\Bolsistas\Auth;
use App\Services\Interfaces\AuthServiceInterface;
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
        $credentials = $this->validate();

        if ($authService->login($credentials, $this->remember)) {
            return $this->redirect(route('login'));
        }

        flash()->error('CPF ou senha incorretos.');
        return $this->redirect(route('bolsistas.login'));
    }

    public function render()
    {
        return view('livewire.bolsistas.auth.login-form');
    }
}
