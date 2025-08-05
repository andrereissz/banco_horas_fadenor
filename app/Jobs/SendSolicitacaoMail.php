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
    public function __construct(protected User $authenticatedUser, protected Bolsa $bolsa, protected string $bolsistaNome,protected string $emailDestinatario)
    {}

    /**
     * Execute the job.
     */
    public function handle(BolsaServiceInterface $bolsaService): void
    {
        $bolsaService->updateStatus($this->bolsa, BolsaStatus::AguardandoEnvio);
        try {
            Mail::to($this->emailDestinatario)
                ->send(new SolicitarBolsa($this->authenticatedUser, $this->bolsa, $this->bolsistaNome));

            $bolsaService->updateStatus($this->bolsa, BolsaStatus::AguardandoResposta);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function failed(BolsaServiceInterface $bolsaService, \Throwable $exception): void
    {
        $bolsaService->updateStatus($this->bolsa, BolsaStatus::Erro);
    }
}
