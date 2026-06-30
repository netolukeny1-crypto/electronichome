<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Divida;
use App\Models\Pagamento;
use App\Models\Cliente;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function vendas()
    {
        $vendas = Venda::with(['cliente', 'produto'])->latest()->get();

        return view('relatorios.vendas', compact('vendas'));
    }

    public function pagamentos()
    {
        $pagamentos = Pagamento::with('divida')->latest()->get();

        return view('relatorios.pagamentos', compact('pagamentos'));
    }

    public function dividas()
    {
        $dividas = Divida::with('venda')->latest()->get();

        return view('relatorios.dividas', compact('dividas'));
    }

    public function clientesDevedores()
    {
        $clientes = Cliente::whereHas('vendas.divida')
            ->with('vendas.divida')
            ->get();

        return view('relatorios.clientes', compact('clientes'));
    }
}