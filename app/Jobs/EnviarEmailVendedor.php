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
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarEmailVendedor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function handle()
    {
        foreach ($this->dados as $vendedor) {
            Mail::to($vendedor['email'])->send(
                new EnviaEmailVendedor($vendedor)
            );
        }
    }
}
