<?php

namespace App\Jobs;

use App\Enums\BolsaStatus;
use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\User;
use App\Services\BolsaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendSolicitacaoMail implements ShouldQueue
{
    use Queueable;

    protected $bolsaService;

    protected $bolsa;

    protected $emailDestinatario;

    protected $authenticatedUser;

    /**
     * Create a new job instance.
     */
    public function __construct(User $authenticatedUser, Bolsa $bolsa, string $emailDestinatario)
    {
        $this->bolsaService = new BolsaService;

        $this->authenticatedUser = $authenticatedUser;
        $this->bolsa = $bolsa;
        $this->emailDestinatario = $emailDestinatario;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->bolsaService->updateStatus($this->bolsa, BolsaStatus::AguardandoEnvio);
        try {
            Mail::to($this->emailDestinatario)
                ->send(new SolicitarBolsa($this->authenticatedUser, $this->bolsa));

            $this->bolsaService->updateStatus($this->bolsa, BolsaStatus::AguardandoResposta);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        $this->bolsaService->updateStatus($this->bolsa, BolsaStatus::Erro);
    }
}
