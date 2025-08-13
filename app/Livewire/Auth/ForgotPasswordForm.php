<?php

namespace App\Livewire\Auth;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ForgotPasswordForm extends Component
{
    public $email;
    public $status;

    protected $rules = [
        'email' => 'required|email',
    ];

    protected function validationAttributes(): array
    {
        return ['email' => 'E-mail'];
    }

    protected function messages(): array
    {
        return ['required' => 'O campo :attribute é obrigatório.'];
    }

    public function sendResetLink(AuthServiceInterface $service)
    {
        $key         = $this->throttleKey();
        $maxAttempts = 5;     // máximo de tentativas
        $decay       = 60;    // janela (em segundos)

        $result = RateLimiter::attempt($key, $maxAttempts, function () use ($service) {
            $this->validate();

            $status = $service->sendResetLink($this->email);
            $this->status = __($status);

            if ($status === Password::RESET_LINK_SENT) {
                RateLimiter::clear($this->throttleKey());
                flash()->success('Solicitação de redefinição de senha enviada com sucesso!');
                return $this->redirect(route('login'), navigate: true);
            }

            flash()->error('Ocorreu um erro ao enviar a solicitação de redefinição de senha.');
            return null;
        }, $decay);

        if ($result === false) {
            $seconds = RateLimiter::availableIn($key);
            $this->resetErrorBag();
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            return;
        }

        return $result;
    }

    private function throttleKey(): string
    {
        return 'forgot:' . sha1(($this->email ?? 'guest') . '|' . request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form');
    }
}
