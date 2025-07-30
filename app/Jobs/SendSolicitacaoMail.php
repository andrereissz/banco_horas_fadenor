<?php

namespace App\Jobs;

use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use App\Models\User;
use App\Services\BolsaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        $this->bolsaService = new BolsaService();

        $this->authenticatedUser = $authenticatedUser;
        $this->bolsa = $bolsa;
        $this->emailDestinatario = $emailDestinatario;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->emailDestinatario)
                ->send(new SolicitarBolsa($this->authenticatedUser, $this->bolsa));
                
            $this->bolsaService->updateStatus($this->bolsa, 1);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        $this->bolsaService->updateStatus($this->bolsa, 5);
    }
}
