<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class PasswordInputField extends Component
{
    #[Modelable]
    public string $value = '';

    public string $type = 'password';

    public function togglePasswordVisibility(): void
    {
        $this->type = $this->type === 'password' ? 'text' : 'password';
    }

    public function render()
    {
        return view('livewire.components.password-input-field');
    }
}
