<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestComissao;
use App\Services\ComissaoService;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    protected $comissaoService;
    public function __construct(ComissaoService $comissaoService)
    {
        $this->comissaoService = $comissaoService;
    }

    public function getComissao(RequestComissao $request)
    {

        return $this->comissaoService->getComissao($request);
    }
}
