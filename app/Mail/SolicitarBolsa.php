<?php

namespace App\Mail;

use App\Enums\BolsaTipo;
use App\Models\Bolsa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitarBolsa extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected User $authenticatedUser, protected Bolsa $bolsa, protected string $bolsistaNome){}

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
            view: $this->bolsa->tipo == BolsaTipo::FADENOR->value ? 'mail.solicitar-bolsa-fadenor-mail' : 'mail.solicitar-bolsa-fapemig-mail',
            with: [
                'bolsa' => $this->bolsa,
                'bolsistaNome' => $this->bolsistaNome,
                'user' => $this->authenticatedUser,
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

        $doc_heteroidentificacao = PDF::loadView('pdfs.doc_heteroidentificacao');
        $doc_lgpd = PDF::loadView('pdfs.doc_termo_lgpd');

        $attachments[] = Attachment::fromData(fn () => $doc_heteroidentificacao->output(), 'doc_heteroidentificacao.pdf')->withMime('application/pdf');
        $attachments[] = Attachment::fromData(fn () => $doc_lgpd->output(), 'doc_termo_lgpd.pdf')->withMime('application/pdf');

        if ($this->bolsa->tipo == 1) {
            $attachments[] = Attachment::fromPath(storage_path('app/documentos/doc_atestado_frequencia.docx'))
                ->as('Atestado de Frequência - BOLSISTA.docx')
                ->withMime('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        }

        return $attachments;
    }
}
