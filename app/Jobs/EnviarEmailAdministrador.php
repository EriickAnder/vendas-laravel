<?php

namespace App\Jobs;

use App\Mail\EnviaEmailVendedor;
use App\Services\VendedorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

namespace App\Jobs;

use App\Mail\EnviaEmailVendedor;
use App\Mail\EnviarEmailAdministrador as MailEnviarEmailAdministrador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailAdministrador implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function handle()
    {

        #Deixei meu email como padrão, mas aqui você pode colocar o email do administrador

        Mail::to('eriickanderson@gmail.com')->send(new MailEnviarEmailAdministrador($this->dados));
    }
}
