<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;

class ForgotPasswordForm extends Component
{
    public $email;
    public $status;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink(AuthServiceInterface $service)
    {
        $key = $this->getRateLimiterKey();

        if ($this->isRateLimited($key)) {
            $this->resetErrorBag();
            flash()->error('Muitas tentativas. Tente novamente em alguns minutos.');
            $this->addError('email', 'Muitas tentativas. Aguarde um momento e tente novamente.');
            return;
        }

        $this->validate();

        $status = $service->sendResetLink($this->email);

        $this->status = __($status);

        if ($status === Password::RESET_LINK_SENT) {
            $this->sendSuccess("Solicitação de redefinição de senha enviada com sucesso!", "Sucesso!");
            return redirect()->route('login');
        }

        if (!$this->isRateLimited($key)) {
            return $this->sendError("Ocorreu um erro ao enviar a solicitação de redefinição de senha.", $key);
        }
    }

    private function isRateLimited(string $key): bool
    {
        return !RateLimiter::remaining($key, 5);
    }

    private function getRateLimiterKey(): string
    {
        return 'reset:' . request()->ip();
    }

    private function sendError(string $message, string $key = null)
    {
        if ($key) {
            RateLimiter::hit($key);
        }

        flash()->error($message);
        $this->addError('email', $message);
    }

    private function sendSuccess(string $message, string $key = null)
    {
        if ($key) {
            RateLimiter::clear($key);
        }

        flash()->success($message, 'Sucesso!');
        return redirect()->route('login')->with('status', $message);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form');
    }
}
