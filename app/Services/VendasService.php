<?php

namespace App\Services;

use App\Models\Vendas;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Log;

class VendasService
{

    public function store(Request $request)
    {
        try {

            $uuid = Uuid::uuid4();
            Vendas::create([
                'vendedor_uuid' => $request->vendedor,
                'valor' => $request->valor,
                'uuid' => $uuid,
            ]);
            return response()->json([
                'message' => 'Venda realizada com sucesso',
                'venda' => [
                    'vendedor_uuid' => $request->vendedor,
                    'venda_uuid' => $uuid,
                    'valor' => $request->valor
                ]
            ], 201);
        } catch (\Exception $e) {

            Log::error("Erro ao cadastrar venda: " . $e->getMessage(), [
                'Vendedor' => $request->vendedor,
                'valor' => $request->valor,
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao cadastrar venda'], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $query = Vendas::select('uuid', 'valor', 'vendedor_uuid', 'created_at')
                ->with(['vendedor' => function ($query) {
                    $query->select('uuid', 'nome', 'email');
                }]);

            // Filtros por data
            if ($request->filled('data_inicio')) {
                $query->whereDate('created_at', '>=', $request->data_inicio);
            }

            if ($request->filled('data_fim')) {
                $query->whereDate('created_at', '<=', $request->data_fim);
            }

            $vendas = $query->paginate(10);

            return response()->json($vendas, 200);
        } catch (\Exception $e) {
            Log::error("Erro ao listar vendas: " . $e->getMessage(), [
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao listar vendas'], 500);
        }
    }


    public function getVendas(Request $request)
    {
        try {

            $query = Vendas::select('uuid', 'valor', 'vendedor_uuid', 'created_at')
                ->where('vendedor_uuid', $request->vendedor);

            // Filtros por data
            if ($request->filled('data_inicio')) {
                $query->whereDate('created_at', '>=', $request->data_inicio);
            }

            if ($request->filled('data_fim')) {
                $query->whereDate('created_at', '<=', $request->data_fim);
            }

            $vendas = $query->paginate(10);

            return response()->json($vendas, 200);
        } catch (\Exception $e) {
            Log::error("Erro ao listar vendas: " . $e->getMessage(), [
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao listar vendas'], 500);
        }
    }

    public function getVendasAll(array $params)
    {
        try {
            $comissaoService = new ComissaoService();
            $query = Vendas::select('uuid', 'vendedor_uuid', 'created_at', 'valor');

            #Filtro para saber se usuario existe
            if (isset($params['vendedor_uuid'])) {
                $query->where('vendedor_uuid', $params['vendedor_uuid']);
            }

            #Filtros por data
            if (isset($params['data_inicio']) && \DateTime::createFromFormat('Y-m-d', $params['data_inicio']) !== false) {
                $query->whereDate('created_at', '>=', $params['data_inicio']);
            }

            if (isset($params['data_fim']) && \DateTime::createFromFormat('Y-m-d', $params['data_fim']) !== false) {
                $query->whereDate('created_at', '<=', $params['data_fim']);
            }

            $vendas = $query->get();
            $totalValor = $vendas->sum('valor');
            $quantidade = $vendas->count();
            $comissoesGeradas = $comissaoService->calculaComissao(0.085, $totalValor);

            return [
                'vendas' => $vendas,
                'quantidade' => $quantidade,
                'total' => $totalValor,
                'comissoesGeradas' => $comissoesGeradas
            ];
        } catch (\Exception $e) {
            Log::error("Erro ao listar vendas: " . $e->getMessage(), [
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao listar vendas'], 500);
        }
    }
}
