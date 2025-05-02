<?php

namespace App\Services;

use App\Models\Vendas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComissaoService
{
    public function getComissao(Request $request)
    {

        try {
            $query = Vendas::selectRaw('SUM(valor) as valorTotal, vendedor_uuid')
                ->where('vendedor_uuid', $request->vendedor);

            // Filtro por data
            if ($request->filled('data_inicio')) {
                $query->whereDate('created_at', '>=', $request->data_inicio);
            }

            if ($request->filled('data_fim')) {
                $query->whereDate('created_at', '<=', $request->data_fim);
            }

            $vendas = $query->groupBy('vendedor_uuid')->first();


            #valida se tem venda ou valor total
            if (!$vendas || !$vendas->valorTotal) {
                return response()->json([
                    'message' => 'Nenhuma venda encontrada para o vendedor informado',
                    'comissao' => [
                        'vendedor_uuid' => $request->vendedor,
                        'valor' => 0,
                        'comissao' => 0
                    ]
                ], 200);
            }
            # Calculo da comissão / Posteriormente pode criar alguma configuração para o percentualdentro do sistema
            $comissao = $this->calculaComissao(0.085, $vendas->valorTotal);
            // $comissao = round($vendas->valorTotal * 0.085, 2);

            return response()->json([

                'comissao' => [
                    'vendedor_uuid' => $request->vendedor,
                    'valor' => $vendas->valorTotal,
                    'comissao' => $comissao
                ]
            ], 200);
        } catch (\Exception $e) {
            Log::error('Erro ao calcular comissão: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao calcular comissão'], 500);
        }
    }

    public function calculaComissao($comissao, $valorTotal)
    {
        $comissao = round($valorTotal * 0.085, 2);
        return $comissao;
    }
}
