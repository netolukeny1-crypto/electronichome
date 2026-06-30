<x-layouts::app :title="'Detalhes da Venda'">

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white rounded-2xl border p-6">

        <h1 class="text-3xl font-bold mb-4">
            Venda EH-{{ str_pad($venda->id,6,'0',STR_PAD_LEFT) }}
        </h1>

    <div class="grid md:grid-cols-2 gap-6 mb-8">

        <div>

            <h2 class="font-bold mb-3">
                Dados do Cliente
            </h2>

            <p><strong>Nome:</strong> {{ $venda->cliente->nome }}</p>
            <p><strong>Telefone:</strong> {{ $venda->cliente->telefone }}</p>
            <p><strong>BI:</strong> {{ $venda->cliente->bi }}</p>
            <p><strong>Endereço:</strong> {{ $venda->cliente->endereco }}</p>

        </div>

        <div>

            <h2 class="font-bold mb-3">
                Dados da Venda
            </h2>

            <p><strong>Pagamento:</strong> {{ $venda->forma_pagamento }}</p>
            <p><strong>Total:</strong> {{ number_format($venda->valor_total,2,',','.') }} Kz</p>
            <p><strong>Data:</strong> {{ $venda->created_at }}</p>

            <p>
    <strong>Estado:</strong>

    {{ $venda->estado }}
</p>
@if($venda->estado == 'Cancelada')

<p>
    <strong>Cancelado em:</strong>
    {{ $venda->cancelado_em }}
</p>

<p>
    <strong>Motivo:</strong>
    {{ $venda->motivo_cancelamento }}
</p>

@endif

        </div>

    </div>

    <h2 class="font-bold mb-4">
        Produtos Vendidos
    </h2>

    <table class="w-full border">

        <thead class="bg-slate-100">

            <tr>

                <th class="p-3 text-left">Produto</th>
                <th class="p-3 text-left">Qtd</th>
                <th class="p-3 text-left">Preço</th>
                <th class="p-3 text-left">Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach($venda->itens as $item)

            <tr class="border-t">

                <td class="p-3">
                    {{ $item->produto->nome }}
                </td>

                <td class="p-3">
                    {{ $item->quantidade }}
                </td>

                <td class="p-3">
                    {{ number_format($item->preco_unitario,2,',','.') }}
                </td>

                <td class="p-3">
                    {{ number_format($item->subtotal,2,',','.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
```

</div>

</div>

<form action="{{ route('vendas.cancelar',$venda->id) }}" method="POST">
    @csrf
    ...
</form>

</div>
</x-layouts::app>

    <label>
        Motivo do cancelamento
    </label>

    <textarea
        name="motivo_cancelamento"
        required
        class="w-full border rounded-lg p-3">
    </textarea>

    <button
        class="mt-3 px-4 py-2 bg-red-600 text-white rounded-lg">

        Cancelar Venda

    </button>

</form>