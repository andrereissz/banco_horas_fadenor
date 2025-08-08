<?php

namespace App\Jobs;

use App\Enums\BolsaStatus;
use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\User;
use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendSolicitacaoMail implements ShouldQueue
{
    use Queueable;

    protected BolsaServiceInterface $bolsaService;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $authenticatedUser, protected Bolsa $bolsa, protected string $bolsistaNome,protected string $emailDestinatario)
    {
        $this->bolsaService = app(BolsaServiceInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->bolsaService->updateStatus($this->bolsa, BolsaStatus::AguardandoEnvio);
        try {
            Mail::to($this->emailDestinatario)
                ->send(new SolicitarBolsa($this->authenticatedUser, $this->bolsa, $this->bolsistaNome));

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
