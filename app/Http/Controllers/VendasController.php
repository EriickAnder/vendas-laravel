<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestGetVendas;
use App\Http\Requests\RequestVenda;
use App\Services\VendasService;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    protected $vendasService;
    public function __construct(VendasService $vendasService)
    {
        $this->vendasService = $vendasService;
    }
    public function store(RequestVenda $request)
    {
        return $this->vendasService->store($request);
    }

    public function index(Request $request)
    {
        return $this->vendasService->index($request);
    }

    public function getVendas(RequestGetVendas $request)
    {
        return $this->vendasService->getVendas($request);
    }
}
