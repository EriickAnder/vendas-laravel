<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\VendedorController;
use App\Jobs\EnviarEmailVendedor;
use App\Services\VendedorService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







// Pode utilizar essa rota para testar o envio de email de vendedores caso não queria utilizar o job
Route::get('/teste-email-vendedor', [EmailController::class, 'sendEmailVendedor'])->name('vendedor.index');
Route::get('/teste-email-adm', [EmailController::class, 'sendEmailAdm'])->name('vendedor.index');
