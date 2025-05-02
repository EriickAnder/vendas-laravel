<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarEmailAdministrador extends Mailable
{
    use Queueable, SerializesModels;
    public $dados;
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function build()
    {
        return $this->subject('Relatório Diário de Vendas - Administrador')
            ->view('emails.templateAdministrador')
            ->with('dados', $this->dados);
    }
}
