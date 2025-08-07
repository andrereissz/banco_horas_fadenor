<?php

namespace App\Livewire\Fundacao\Auth;

use App\Services\Interfaces\AuthServiceInterface;
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
            'password' => ['required']
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'username' => 'Usuário',
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
            return $this->redirect(route('fundacao.dashboard'));
        }

        flash()->error('Usuário ou senha incorretos.');
        return $this->redirect(route('fundacao.login'));
    }

    public function render()
    {
        return view('livewire.fundacao.auth.login-form');
    }
}
