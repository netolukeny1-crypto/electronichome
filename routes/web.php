<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\DividaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LogoutController;


/*
|--------------------------------------------------------------------------
| Página Inicial
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

/*
|--------------------------------------------------------------------------
| Carrinho
|--------------------------------------------------------------------------
*/

Route::get('/carrinho', [CarrinhoController::class, 'index'])
    ->name('carrinho.index');

Route::get('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])
    ->name('carrinho.adicionar');

Route::get('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])
    ->name('carrinho.remover');

Route::get('/carrinho/aumentar/{id}', [CarrinhoController::class, 'aumentar'])
    ->name('carrinho.aumentar');

Route::get('/carrinho/diminuir/{id}', [CarrinhoController::class, 'diminuir'])
    ->name('carrinho.diminuir');

Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizar'])
    ->name('carrinho.finalizar');

/*
|--------------------------------------------------------------------------
| Faturas
|--------------------------------------------------------------------------
*/

Route::get('/fatura/venda/{id}', [FaturaController::class, 'venda']);

Route::get('/fatura/{venda}', [FaturaController::class, 'show'])
    ->name('fatura.show');

/*
|--------------------------------------------------------------------------
| Área Protegida
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('clientes', ClienteController::class);

    Route::resource('produtos', ProdutoController::class);

    Route::resource('vendas', VendaController::class);

    Route::resource('pagamentos', PagamentoController::class);

    Route::resource('dividas', DividaController::class);

    /*
    |--------------------------------------------------------------------------
    | Recibos
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pagamentos/{id}/recibo',
        [PagamentoController::class, 'recibo']
    )->name('pagamentos.recibo');

    /*
    |--------------------------------------------------------------------------
    | Cancelamento de Venda
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/vendas/{id}/cancelar',
        [VendaController::class, 'cancelar']
    )->name('vendas.cancelar');

    /*
    |--------------------------------------------------------------------------
    | Relatórios
    |--------------------------------------------------------------------------
    */

    Route::get('/relatorios', [RelatorioController::class, 'index']);

    Route::get('/relatorios/vendas', [RelatorioController::class, 'vendas']);

    Route::get('/relatorios/pagamentos', [RelatorioController::class, 'pagamentos']);

    Route::get('/relatorios/dividas', [RelatorioController::class, 'dividas']);

    Route::get('/relatorios/clientes', [RelatorioController::class, 'clientesDevedores']);
    
});

Route::post('/sair', LogoutController::class)
    ->name('sair');

    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    Route::get('/reset-admin', function () {
     $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@electronichome.com',
        'password' => Hash::make('Admin123'),
    ]);

    return $user;
});