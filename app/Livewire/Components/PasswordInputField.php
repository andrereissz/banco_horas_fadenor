<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PasswordInputField extends Component
{
    public $type = 'password';

    public function render()
    {
        return view('livewire.components.password-input-field');
    }

    public function togglePasswordVisibility()
    {
        $this->type = $this->type === 'password' ? 'text' : 'password';
    }
}
