<?php

namespace App\Livewire\Fundacao;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class UserPasswordUpdateForm extends Component
{
    public string $password = '';

    public string $password_confirmation = '';

    public string $type = 'password';

    protected $rules = [
        'password' => 'required|min:8|confirmed',
    ];

    protected function validationAttributes(): array
    {
        return [
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

    public function updatePassword(): void
    {
        $key         = $this->throttleKey();
        $maxAttempts = 5;     // máximo de tentativas
        $decay       = 60;    // janela (em segundos)

        $result = RateLimiter::attempt($key, $maxAttempts, function () {
            $this->validate();

            User::find(Auth::user()->id)->update([
                'password' => bcrypt($this->password)
            ]);

            flash()->success('Senha atualizada com sucesso!');
            return redirect()->route('fundacao.password.update');
        }, $decay);

        if($result === false) {
            $seconds = RateLimiter::availableIn($key);
            flash()->error("Muitas tentativas. Tente novamente em {$seconds}s.");
            return;
        }
    }
    private function throttleKey(): string
    {
        return 'user-fundacao-password-update:' . request()->ip();
    }

    public function togglePasswordVisibility(): void
    {
        $this->type = $this->type === 'password' ? 'text' : 'password';
    }

    public function render()
    {
        return view('livewire.fundacao.user-password-update-form');
    }
}
