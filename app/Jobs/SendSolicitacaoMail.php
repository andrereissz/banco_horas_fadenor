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
    protected $paths = [];

    /**
     * Create a new job instance.
     */
    public function __construct(User $authenticatedUser, Bolsa $bolsa, string $emailDestinatario, array $paths)
    {
        $this->bolsaService = new BolsaService();

        $this->authenticatedUser = $authenticatedUser;
        $this->bolsa = $bolsa;
        $this->emailDestinatario = $emailDestinatario;
        $this->paths = $paths;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $disk = Storage::disk('tmp');

        try {
            Mail::to($this->emailDestinatario)
                ->send(new SolicitarBolsa($this->authenticatedUser, $this->bolsa, $this->paths));

                $this->bolsaService->updateStatus($this->bolsa, 1);
        } catch (\Exception $e) {
            foreach ($this->paths as $path) {
                $disk->delete($path);
            }

            $this->bolsaService->updateStatus($this->bolsa, 4);
            throw $e;
        }

        foreach ($this->paths as $path) {
            $disk->delete($path);
        }
    }
}
