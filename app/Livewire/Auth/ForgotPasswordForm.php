<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Interfaces\AuthServiceInterface;

class ForgotPasswordForm extends Component
{
    public $email;
    public $status;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink(AuthServiceInterface $service)
    {
        $this->validate();

        $status = $service->sendResetLink($this->email);

        $this->status = __($status);

        if ($status !== \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form');
    }
}
