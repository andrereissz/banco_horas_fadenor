<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Password;

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

    public function mount($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function resetPassword(AuthServiceInterface $service)
    {
        $this->validate();

        $status = $service->resetPassword([
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        $this->status = __($status);

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password-form');
    }
}
