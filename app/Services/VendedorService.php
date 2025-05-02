<?php

namespace App\Services;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Log;

class VendedorService
{

    public function store(Request $request)
    {
        try {

            $uuid = Uuid::uuid4();
            Vendedor::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'uuid' => $uuid,
            ]);
            return response()->json(['message' => 'Vendedor cadastrado com sucesso', 'vendedor' => $uuid], 201);
        } catch (\Exception $e) {

            Log::error("Erro ao cadastrar vendedor: " . $e->getMessage(), [
                'nome' => $request->nome,
                'email' => $request->email,
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao cadastrar vendedor'], 500);
        }
    }

    public function index(Request $request)
    {
        try {

            $query = Vendedor::query();

            # filtro por data de criação
            if ($request->has('data_inicio')) {
                $query->whereDate('created_at', '>=', $request->data_inicio);
            }
            if ($request->has('data_fim')) {
                $query->whereDate('created_at', '<=', $request->input('data_fim'));
            }

            # filtro de status
            if ($request->has('status')) {
                $query->where('status', $request->input('status'));
            }

            $vendedores = $query->paginate(10);
            return response()->json($vendedores, 200);
        } catch (\Exception $e) {
            Log::error("Erro ao listar vendedores: " . $e->getMessage(), [
                'descricao' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Erro ao listar vendedores'], 500);
        }
    }


    public function listVendedoresVendas(array $params)
    {
        try {
            $comissaoService = new ComissaoService();

            $query = Vendedor::with(['vendas' => function ($q) use ($params) {

                #Filtro para saber se usuario existe
                if (isset($params['vendedor_uuid'])) {
                    $q->where('vendedor_uuid', $params['vendedor_uuid']);
                }

                if (isset($params['data_inicio']) && \DateTime::createFromFormat('Y-m-d', $params['data_inicio']) !== false) {
                    $q->whereDate('created_at', '>=', $params['data_inicio']);
                }

                if (isset($params['data_fim']) && \DateTime::createFromFormat('Y-m-d', $params['data_fim']) !== false) {
                    $q->whereDate('created_at', '<=', $params['data_fim']);
                }
            }]);

            $vendedores = $query->get()->map(function ($vendedor) use ($comissaoService) {
                $totalVendas = $vendedor->vendas->sum('valor');
                return [
                    'nome' => $vendedor->nome,
                    'email' => $vendedor->email,
                    'total_vendas' => $totalVendas,
                    'comissao' => $comissaoService->calculaComissao(0.0085, $totalVendas),
                    'vendas' => $vendedor->vendas
                ];
            });

            return $vendedores;
        } catch (\Exception $e) {
            Log::error("Erro ao buscar vendedores: " . $e->getMessage(), [
                'descricao' => $e->getTraceAsString()
            ]);
            return collect();
        }
    }
}
