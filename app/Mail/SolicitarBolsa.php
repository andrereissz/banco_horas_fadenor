<?php

namespace App\Mail;

use App\Models\Bolsa;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitarBolsa extends Mailable
{
    protected User $authenticatedUser;
    protected Bolsa $bolsa;
    protected array $paths;


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(User $authenticatedUser, Bolsa $bolsa, array $paths)
    {
        $this->authenticatedUser = $authenticatedUser;
        $this->bolsa = $bolsa;
        $this->paths = $paths;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitação de Bolsa',
            from: $this->authenticatedUser->email,
            replyTo: $this->authenticatedUser->email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.bolsa',
            with: [
                'bolsa' => $this->bolsa,
                'user' => $this->authenticatedUser
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        $pdf = PDF::loadView('pdfs.doc_heteroidentificacao');

        $attachments[] = Attachment::fromData(fn() => $pdf->output(), 'doc_heteroidentificacao.pdf')->withMime('application/pdf');

        foreach ($this->paths as $path) {
            $attachments[] = Attachment::fromStorageDisk('tmp', $path)->withMime('application/pdf');
        }

        return $attachments;
    }
}
