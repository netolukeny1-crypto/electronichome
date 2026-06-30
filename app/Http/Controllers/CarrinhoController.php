<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\VendaItem;
use App\Models\Divida;
use App\Models\Pagamento;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{

    public function aumentar($id)
{
    $carrinho = session()->get('carrinho', []);

    if(isset($carrinho[$id]))
    {
        $carrinho[$id]['quantidade']++;
    }

    session()->put('carrinho', $carrinho);

    return redirect()->route('carrinho.index');
}

public function diminuir($id)
{
    $carrinho = session()->get('carrinho', []);

    if(isset($carrinho[$id]))
    {
        if($carrinho[$id]['quantidade'] > 1)
        {
            $carrinho[$id]['quantidade']--;
        }
    }

    session()->put('carrinho', $carrinho);

    return redirect()->route('carrinho.index');
}

    public function index()
{
    $carrinho = session()->get('carrinho', []);

    $clientes = \App\Models\Cliente::all();

    return view(
        'carrinho.index',
        compact('carrinho', 'clientes')
    );
}

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {

            $carrinho[$id]['quantidade']++;

        } else {

            $carrinho[$id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'imagem' => $produto->imagem,
                'quantidade' => 1
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()
            ->route('carrinho.index')
            ->with('success', 'Produto adicionado ao carrinho com sucesso!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
        }

        session()->put('carrinho', $carrinho);

        return redirect()
            ->route('carrinho.index')
            ->with('success', 'Produto removido do carrinho com sucesso!');
    }

    public function finalizar(Request $request)
{
    $carrinho = session()->get('carrinho', []);

    if (!$carrinho) {
        return back()->with('erro', 'Carrinho vazio');
    }

    DB::beginTransaction();

    try {

        // 1. CRIAR VENDA PRIMEIRO
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'valor_total' => 0,
            'valor_pago' => $request->valor_pago ?? 0,
            'forma_pagamento' => $request->forma_pagamento
        ]);

        $total = 0;

        // 2. ITENS DA VENDA
        foreach ($carrinho as $id => $item) {

            $produto = Produto::findOrFail($id);

            // 🔴 VALIDAR STOCK
            if ($produto->stock < $item['quantidade']) {
                throw new \Exception("Stock insuficiente para {$produto->nome}");
            }

            $subtotal = $item['preco'] * $item['quantidade'];

            VendaItem::create([
                'venda_id' => $venda->id,
                'produto_id' => $id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'subtotal' => $subtotal
            ]);

            // reduzir stock
            $produto->stock -= $item['quantidade'];
            $produto->save();

            $total += $subtotal;
        }

        // 3. ATUALIZAR VENDA
        $venda->valor_total = $total;

        // pagamento
        if ($request->forma_pagamento === 'Pré-pago') {
            $venda->valor_pago = $total;
        }

        // 🔵 gerar número de fatura (ERP simples)
        $venda->numero_fatura = 'EH-' . date('Y') . '-' . str_pad($venda->id, 6, '0', STR_PAD_LEFT);

        $venda->save();

        // 4. CRIAR DÍVIDA SE NECESSÁRIO
        if ($request->forma_pagamento !== 'Pré-pago') {

            $saldo = $total - ($request->valor_pago ?? 0);

            Divida::create([
                'venda_id' => $venda->id,
                'valor_total' => $total,
                'valor_pago' => $request->valor_pago ?? 0,
                'saldo' => $saldo,
                'estado' => $saldo > 0 ? 'Parcial' : 'Liquidada'
            ]);
        }

        // 5. LIMPAR CARRINHO
        session()->forget('carrinho');

        DB::commit();

        // 6. REDIRECIONAR PARA FATURA
        return redirect()->route('fatura.show', $venda->id);

    } catch (\Exception $e) {
        DB::rollback();

        return back()->with('erro', $e->getMessage());
    }
}
}