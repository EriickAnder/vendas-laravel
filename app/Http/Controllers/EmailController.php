<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestGetVendas;
use App\Http\Requests\RequestVenda;
use App\Jobs\EnviarEmailAdministrador;
use App\Jobs\EnviarEmailVendedor;
use App\Services\EmailService;
use App\Services\VendasService;
use App\Services\VendedorService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $dataAtual;
    protected $dataFinal;
    public function __construct()
    {
        $this->dataAtual = date('Y-m-d');
        $this->dataFinal = date('Y-m-d');
    }

    /**
     * Pode utilizar essa rota para testar o envio de email de vendedores caso não queira utilizar o job.
     * OBS: Como estou usando o Mailtrap, é enviado email apenas para o vendedor que esteja cadastrado na criação da conta.
     * No caso utilizei o meu. Caso queira utilizar outro, é necessário realizar o cadastro no Mailtrap e colocar suas credenciais no .env.
     */
    public function sendEmailVendedor(Request $request)
    {
        $params = [
            'data_inicio' => $this->dataAtual,
            'data_fim' => $this->dataFinal,
        ];

        if (isset($request->vendedor)) {
            $params['vendedor_uuid'] = $request->vendedor;
        }

        $emailService = new EmailService();
        $emailService->sendEmailVendedor($params);
    }

    public function sendEmailAdm()
    {
        $params = [
            'data_inicio' => $this->dataAtual,
            'data_fim' => $this->dataFinal,
        ];
        $emailService = new EmailService();
        $emailService->sendEmailAdm($params);
    }
}
