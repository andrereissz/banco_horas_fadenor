<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;

class ResetPasswordForm extends Component
{
    public $token;
    public $email;
    public string $password = '';
    public string $password_confirmation = '';
    public $status;

    public string $type = 'password';

    protected $rules = [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];


    protected function validationAttributes(): array
    {
        return [
            'email' => 'E-mail',
            'password' => 'Senha',
        ];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'confirmed' => 'As senhas informadas não conferem.',
            'min' => 'A senha deve ter pelo menos 8 caracteres.',
        ];
    }

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email');
    }

    public function resetPassword(AuthServiceInterface $service)
    {
        $key = $this->getRateLimiterKey();

        $credentials = $this->validate();

        if ($this->isRateLimited($key)) {
            $this->resetErrorBag();
            flash()->error('Muitas tentativas. Aguarde um momento e tente novamente.');
            return;
        }

        $status = $service->resetPassword($credentials);

        if ($status === Password::PASSWORD_RESET) {
            RateLimiter::clear($key);
            flash()->success("Senha alterada com sucesso!");
            return $this->redirect(route('login'), navigate: true);
        }

        if (!$this->isRateLimited($key)) {
            return $this->sendError('As senhas informadas não conferem.', $key);
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
        return 'reset:' . request()->ip();
    }

    private function sendError(string $message, ?string $key = null)
    {
        if ($key) {
            RateLimiter::hit($key);
        }

        flash()->error($message);
        $this->addError('password', $message);

        return null;
    }

    public function togglePasswordVisibility(): void
    {
        $this->type = $this->type === 'password' ? 'text' : 'password';
    }

    public function render()
    {
        return view('livewire.auth.reset-password-form');
    }
}
