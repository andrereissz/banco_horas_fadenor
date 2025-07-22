<?php

namespace App\Jobs;

use App\Mail\SolicitarBolsa;
use App\Models\Bolsa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendSolicitacaoMail implements ShouldQueue
{
    use Queueable;

    protected $bolsa;
    protected $emailCoordenador;
    protected $authenticatedUserMail;
    protected $paths = [];

    /**
     * Create a new job instance.
     */
    public function __construct(Bolsa $bolsa, string $emailCoordenador, string $authenticatedUserMail, array $paths)
    {
        $this->bolsa = $bolsa;
        $this->emailCoordenador = $emailCoordenador;
        $this->authenticatedUserMail = $authenticatedUserMail;
        $this->paths = $paths;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $disk = Storage::disk('tmp');

        Mail::to($this->emailCoordenador)->send(new SolicitarBolsa($this->bolsa, $this->authenticatedUserMail, $this->paths));

        foreach ($this->paths as $path) {
            $disk->delete($path);
        }
    }
}
