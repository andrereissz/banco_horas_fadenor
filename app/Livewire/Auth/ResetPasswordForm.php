<?php

namespace App\Livewire\Auth;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ResetPasswordForm extends Component
{
    public $token;
    public $email;

    public string $password = '';
    public string $password_confirmation = '';

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
            'required'  => 'O campo :attribute é obrigatório.',
            'confirmed' => 'As senhas informadas não conferem.',
            'min'       => 'A senha deve ter pelo menos 8 caracteres.',
        ];
    }

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email');
    }

    public function resetPassword(AuthServiceInterface $service)
    {
        $key         = $this->throttleKey();
        $maxAttempts = 5;     // máximo de tentativas
        $decay       = 60;    // janela (em segundos)

        $result = RateLimiter::attempt($key, $maxAttempts, function () use ($service) {
                $credentials = $this->validate();

            $status = $service->resetPassword($credentials);

            if ($status === Password::PASSWORD_RESET) {
                RateLimiter::clear($this->throttleKey());
                flash()->success('Senha alterada com sucesso!');
                return redirect()->route('login');
            }

            flash()->error('Falha ao alterar senha.');
            $this->addError('password', 'As senhas informadas não conferem.');
            $this->reset();
            return false;
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
        return 'reset:' . sha1(($this->email ?? 'guest') . '|' . request()->ip());
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
