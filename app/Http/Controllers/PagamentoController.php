<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Divida;
use App\Models\DividaPagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::with([
            'divida.venda.cliente'
        ])->latest()->get();

        $totalRecebido = Pagamento::sum('valor');

        $pagamentosHoje = Pagamento::whereDate(
            'data_pagamento',
            today()
        )->count();

        $dividasLiquidadas = Divida::where('estado', 'Liquidada')->count();

        $saldoAberto = Divida::sum('saldo');

        return view('pagamentos.index', compact(
            'pagamentos',
            'totalRecebido',
            'pagamentosHoje',
            'dividasLiquidadas',
            'saldoAberto'
        ));
    }

    public function create()
    {
        $dividas = Divida::with('venda.cliente')->get();
        return view('pagamentos.create', compact('dividas'));
    }

    public function store(Request $request)
{
    $request->validate([
        'divida_id' => 'required',
        'valor' => 'required|numeric|min:1'
    ]);

    $divida = Divida::findOrFail($request->divida_id);

    if ($divida->estado === 'Liquidada') {
        return back()->with('erro', 'Esta dívida já está liquidada.');
    }

    // 1. CRIAR PAGAMENTO
    $pagamento = Pagamento::create([
        'divida_id' => $divida->id,
        'valor' => $request->valor,
        'metodo_pagamento' => $request->metodo_pagamento,
        'observacao' => $request->observacao,
        'data_pagamento' => now(),
        'user_id' => auth()->id()
    ]);

    // 2. RECIBO
    $pagamento->numero_recibo =
        'REC-' . date('Y') . '-' . str_pad($pagamento->id, 6, '0', STR_PAD_LEFT);

    $pagamento->save();

    // 3. HISTÓRICO (ENTRADA vs PRESTAÇÃO)
    DividaPagamento::create([
        'divida_id' => $divida->id,
        'valor' => $request->valor,
        'tipo' => $divida->valor_pago == 0 ? 'Entrada' : 'Prestação'
    ]);

    // 4. ATUALIZAR DÍVIDA
    $divida->valor_pago += $request->valor;
    $divida->saldo = $divida->valor_total - $divida->valor_pago;

    if ($divida->saldo <= 0) {
        $divida->saldo = 0;
        $divida->estado = 'Liquidada';
    } else {
        $divida->estado = 'Parcial';
    }

    $divida->save();

    return redirect()
        ->route('pagamentos.index')
        ->with('success', 'Pagamento registado com sucesso.');
}

    public function recibo($id)
    {
        $pagamento = Pagamento::with([
            'divida.venda.cliente',
            'user'
        ])->findOrFail($id);

        return view('recibos.show', compact('pagamento'));
    }
}