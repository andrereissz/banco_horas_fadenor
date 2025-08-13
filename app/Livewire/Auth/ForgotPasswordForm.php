<?php

namespace App\Livewire\Auth;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ForgotPasswordForm extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|min:3',
    ];

    protected function validationAttributes(): array
    {
        return ['email' => 'E-mail'];
    }

    protected function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O e-mail informado é inválido.'
        ];
    }

    public function sendResetLink(AuthServiceInterface $service)
    {
        $key         = $this->throttleKey();
        $maxAttempts = 5;     // máximo de tentativas
        $decay       = 60;    // janela (em segundos)

        $result = RateLimiter::attempt($key, $maxAttempts, function () use ($service) {

            $result = $this->validate();

            $status = $service->sendResetLink($this->email);

            if ($status === Password::RESET_LINK_SENT) {
                RateLimiter::clear($this->throttleKey());
                flash()->success('Solicitação de redefinição de senha enviada com sucesso!');
                return redirect()->route('login');
            }

            flash()->error('Falha ao solicitar redefinição de senha.');
            $this->addError('email', 'O e-mail informado é inválido.');
            $this->reset();
            return null;
        }, $decay);


        if ($result === false) {
            $seconds = RateLimiter::availableIn($key);
            $this->resetErrorBag();
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            $this->reset();
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
