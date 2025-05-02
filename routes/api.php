<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComissaoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'vendedor', 'middleware' => ['auth:api']], function () {
    Route::post('/', [VendedorController::class, 'store'])->name('vendedor.store');
    Route::get('/', [VendedorController::class, 'index'])->name('vendedor.index');
});

Route::group(['prefix' => 'venda', 'middleware' => ['auth:api']], function () {

    Route::post('/', [VendasController::class, 'store'])->name('venda.store');
    Route::get('/', [VendasController::class, 'index'])->name('venda.index');
    Route::get('/{vendedor}/vendas', [VendasController::class, 'getVendas'])->name('venda.vendedor.vendas');
});

Route::group(['prefix' => 'comissao', 'middleware' => ['auth:api']], function () {
    Route::get('/{vendedor}', [ComissaoController::class, 'getComissao'])->name('comissao.vendedor');
});


Route::group(['prefix' => 'email', 'middleware' => ['auth:api']], function () {
    Route::get('/{vendedor}', [EmailController::class, 'sendEmailVendedor'])->name('email.vendedor');
});
