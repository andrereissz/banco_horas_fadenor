<?php

namespace App\Livewire\Bolsistas\Auth;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
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
        $key = $this->getRateLimiterKey();

        if ($this->isRateLimited($key)) {
            $this->resetErrorBag();
            flash()->error('Muitas tentativas. Tente novamente em alguns minutos.', 'Erro!');
            $this->addError('cpf', 'Muitas tentativas. Aguarde um momento e tente novamente.');
            return;
        }

        $credentials = $this->validate();

        if ($authService->login($credentials, $this->remember)) {
            return redirect()->route('bolsistas.dashboard');
        }

        if (!$this->isRateLimited($key)) {
            return $this->sendError('CPF ou senha incorretos.', $key);
        }

    }

    /*** Helpers compartilhados ***/
    private function isRateLimited(string $key): bool
    {
        // 5 tentativas por IP
        return ! RateLimiter::remaining($key, 5);
    }

    private function getRateLimiterKey(): string
    {
        return 'login:' . request()->ip();
    }

    private function sendError(string $message, ?string $key = null)
    {
        if ($key) {
            RateLimiter::hit($key);
        }

        flash()->error($message, 'Erro!');
        $this->addError('cpf', $message);

        return null;
    }

    public function render()
    {
        return view('livewire.bolsistas.auth.login-form');
    }
}
