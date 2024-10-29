<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RespostaSolicitacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitacao;
    public $mensagem;

    public function __construct($solicitacao, $mensagem = null)
    {
        $this->solicitacao = $solicitacao;
        $this->mensagem = $mensagem;
    }

    public function build()
    {
        $emailContent = EmailTemplate::first()->content;

        $emailContent = str_replace(':nome', $this->solicitacao->nome, $emailContent);
        $emailContent = str_replace(':vaga', $this->solicitacao->vaga, $emailContent);
        $emailContent = str_replace(':mensagem', $this->mensagem, $emailContent);
        $emailContent = str_replace(':aprovacao', $this->solicitacao->aprovacao === 'aprovada' ? 'aprovada' : 'não aprovada', $emailContent);

        return $this->view('emails.resposta_solicitacao')
                    ->with(['content' => $emailContent])
                    ->subject('Resposta à Sua Solicitação');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resposta Solicitacao Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
