<?php

namespace App\Jobs;

use App\Enums\BolsaStatus;
use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\User;
use App\Providers\BolsaServiceProvider;
use App\Services\BolsaService;
use App\Services\BolsaServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendSolicitacaoMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected BolsaServiceInterface $bolsaService, protected User $authenticatedUser, protected Bolsa $bolsa, protected string $emailDestinatario)
    {}

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
