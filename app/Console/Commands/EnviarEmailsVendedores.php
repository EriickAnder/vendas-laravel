<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmailService;
use App\Jobs\EnviarEmailVendedor;

class EnviarEmailsVendedores extends Command
{
    protected $signature = 'email:vendedores';
    protected $description = 'Envia e-mails para vendedores com o resumo de vendas do dia';

    protected $emailService;

    protected $dataAtual;
    protected $dataFinal;
    public function __construct(EmailService $emailService)
    {
        parent::__construct();
        $this->emailService = $emailService;
        $this->dataAtual = date('Y-m-d');
        $this->dataFinal = date('Y-m-d');
    }

    public function handle()
    {
        $params = [
            'data_inicio' => $this->dataAtual,
            'data_fim' => $this->dataFinal,
        ];

        $this->emailService->sendEmailVendedor($params);
    }
}
