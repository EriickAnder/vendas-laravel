<?php

namespace App\Services;

use App\Jobs\EnviarEmailAdministrador;
use App\Jobs\EnviarEmailVendedor;

use Illuminate\Support\Facades\Log;

class EmailService
{
    public function sendEmailVendedor(array $params)
    {
        try {
            $vendedorService = new VendedorService();
            $dados = $vendedorService->listVendedoresVendas($params);

            if (empty($dados)) {
                return response()->json(['message' => 'Nenhuma venda encontrada para enviar.'], 204);
            }

            EnviarEmailVendedor::dispatch($dados);

            return response()->json(['message' => 'E-mail enviado com sucesso']);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email para vendedor: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao enviar e-mail'], 500);
        }
    }
    public function sendEmailAdm(array $params)
    {
        try {
            $vendasService = new VendasService();
            $dados = $vendasService->getVendasAll($params);


            if (empty($dados)) {
                return response()->json(['message' => 'Nenhuma venda encontrada para enviar.'], 204);
            }

            EnviarEmailAdministrador::dispatch($dados);
            return response()->json(['message' => 'E-mail enviado com sucesso']);
        } catch (\Exception $e) {
            Log::error('Erro ao enviar email para vendedor: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao enviar e-mail'], 500);
        }
    }
}
