<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestVendedor;
use App\Services\VendedorService;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    protected $vendedorService;

    public function __construct(VendedorService $vendedorService)
    {
        $this->vendedorService = $vendedorService;
    }
    public function store(RequestVendedor $request)
    {
        return $this->vendedorService->store($request);
    }

    public function index(Request $request)
    {
        return $this->vendedorService->index($request);
    }
}
