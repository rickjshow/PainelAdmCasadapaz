<?php

namespace App\Mail;

use App\Models\Contato;
use App\Models\EmailTemplate;
use App\Models\TemplateEmail;
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
    $textosEmail = TemplateEmail::whereIn('key', ['ola', 'agradecimento', 'aprovacao', 'recusa', 'despedida'])
                                ->pluck('conteudo', 'key');

    $endereco = Contato::all()->first();

    return $this->view('emails.resposta_solicitacao')
                ->with([
                    'solicitacao' => $this->solicitacao,
                    'mensagem' => $this->mensagem,
                    'textosEmail' => $textosEmail,
                    'endereco' => $endereco
                ])
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
