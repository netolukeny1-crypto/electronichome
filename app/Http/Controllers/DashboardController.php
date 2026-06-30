<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Divida;
use App\Models\Pagamento;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();

        $totalDividasPendentes = Divida::where('estado', 'Pendente')->count();
        $totalDividasParciais = Divida::where('estado', 'Parcial')->count();
        $totalDividasLiquidadas = Divida::where('estado', 'Liquidada')->count();

        $valorTotalDividas = Divida::whereIn('estado', ['Pendente', 'Parcial'])
            ->sum('saldo');

        $pagamentosRecebidos = Pagamento::sum('valor');

        return view('dashboard', compact(
            'totalClientes',
            'totalProdutos',
            'totalDividasPendentes',
            'totalDividasParciais',
            'totalDividasLiquidadas',
            'valorTotalDividas',
            'pagamentosRecebidos'
        ));
    }
}