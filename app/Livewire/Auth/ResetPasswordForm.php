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
    public $password;
    public $password_confirmation;
    public $status;

    protected $rules = [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email');
    }

    public function resetPassword(AuthServiceInterface $service)
    {
        $key = $this->getRateLimiterKey();

        if ($this->isRateLimited($key)) {
            $this->resetErrorBag();
            flash()->error('Muitas tentativas. Aguarde um momento e tente novamente.');
            return;
        }


        $credentials = $this->validate();

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

    public function render()
    {
        return view('livewire.auth.reset-password-form');
    }
}
