<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Venda::with('cliente');

        if ($request->pesquisa) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->pesquisa . '%');
            });
        }

        if ($request->forma_pagamento) {
            $query->where('forma_pagamento', $request->forma_pagamento);
        }

        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        $vendas = $query->latest()->paginate(20);

        $totalVendas = \App\Models\Venda::sum('valor_total');
        $vendasHoje = \App\Models\Venda::whereDate('created_at', today())->count();
        $faturacaoHoje = \App\Models\Venda::whereDate('created_at', today())->sum('valor_total');
        $ticketMedio = \App\Models\Venda::avg('valor_total');
        $canceladas = \App\Models\Venda::where('estado', 'Cancelada')->count();
        $clientesAtendidos = \App\Models\Venda::distinct('cliente_id')->count();

        return view('vendas.index', compact(
            'vendas',
            'totalVendas',
            'vendasHoje',
            'faturacaoHoje',
            'ticketMedio',
            'canceladas',
            'clientesAtendidos'
        ));
    }

    public function create()
    {
        return view('vendas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'forma_pagamento' => 'required',
            'produtos' => 'required|array',
            'quantidades' => 'required|array',
            'valor_pago' => 'nullable|numeric|min:0'
        ]);

        // 1. CRIAR VENDA
        $venda = \App\Models\Venda::create([
            'cliente_id' => $request->cliente_id,
            'valor_total' => 0,
            'valor_pago' => 0,
            'forma_pagamento' => $request->forma_pagamento
        ]);

        $total = 0;

        // 2. ITENS DA VENDA
        foreach ($request->produtos as $index => $produto_id) {

            $produto = \App\Models\Produto::findOrFail($produto_id);
            $quantidade = $request->quantidades[$index];

            if ($produto->stock < $quantidade) {
                return back()->with('erro', "Stock insuficiente para {$produto->nome}");
            }

            $subtotal = $produto->preco * $quantidade;

            $produto->stock -= $quantidade;
            $produto->save();

            \App\Models\VendaItem::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto->id,
                'quantidade' => $quantidade,
                'preco_unitario' => $produto->preco,
                'subtotal' => $subtotal
            ]);

            $total += $subtotal;
        }

        // 3. ATUALIZAR VENDA
        $venda->valor_total = $total;

        $entrada = $request->valor_pago ?? 0;

        if ($request->forma_pagamento === 'Pré-pago') {
            $venda->valor_pago = $total;
            $venda->estado = 'Concluída';
        } else {
            $venda->valor_pago = $entrada;
        }

        $venda->save();

        // 4. CRIAR DÍVIDA (SE NECESSÁRIO)
        if ($request->forma_pagamento !== 'Pré-pago') {

            $divida = \App\Models\Divida::create([
                'venda_id' => $venda->id,
                'valor_total' => $total,
                'valor_pago' => $entrada,
                'saldo' => $total - $entrada,
                'estado' => $entrada > 0 ? 'Parcial' : 'Pendente'
            ]);

            // 5. REGISTAR ENTRADA NO DIA DA COMPRA
            if ($entrada > 0) {

                // HISTÓRICO DA DÍVIDA
                \App\Models\DividaPagamento::create([
                    'divida_id' => $divida->id,
                    'valor' => $entrada,
                    'tipo' => 'Entrada'
                ]);

                // PAGAMENTO
                $pagamento = \App\Models\Pagamento::create([
                    'divida_id' => $divida->id,
                    'valor' => $entrada,
                    'metodo_pagamento' => 'Entrada',
                    'observacao' => 'Pagamento inicial da venda',
                    'data_pagamento' => now(),
                    'user_id' => auth()->id()
                ]);

                $pagamento->numero_recibo =
                    'REC-' . date('Y') . '-' . str_pad($pagamento->id, 6, '0', STR_PAD_LEFT);

                $pagamento->save();
            }
        }

        return redirect()
            ->route('vendas.create')
            ->with('success', 'Venda realizada com sucesso!');
    }

    public function cancelar(Request $request, $id)
    {
        $venda = \App\Models\Venda::with([
            'cliente',
            'itens.produto',
            'divida.pagamentos'
        ])->findOrFail($id);

        if ($venda->estado === 'Cancelada') {
            return back()->with('erro', 'Esta venda já foi cancelada.');
        }

        foreach ($venda->itens as $item) {
            $produto = $item->produto;
            $produto->stock += $item->quantidade;
            $produto->save();
        }

        $venda->estado = 'Cancelada';
        $venda->cancelado_por = auth()->id();
        $venda->cancelado_em = now();
        $venda->motivo_cancelamento = $request->motivo_cancelamento;
        $venda->save();

        return back()->with('success', 'Venda cancelada com sucesso.');
    }
}