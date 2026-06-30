<x-layouts::app :title="'Pagamentos - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Pagamentos
            </h1>

            <p class="text-slate-500">
                Histórico e controlo financeiro
            </p>
        </div>

        <a href="{{ route('pagamentos.create') }}"
           class="px-4 py-2 border rounded-xl hover:bg-slate-100">

            Novo Pagamento

        </a>

    </div>

    <!-- RESUMO -->

    <div class="grid md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Recebido</p>
            <h2 class="text-xl font-bold text-slate-800">
                {{ number_format($totalRecebido,2,',','.') }} Kz
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Pagamentos Hoje</p>
            <h2 class="text-xl font-bold text-slate-800">
                {{ $pagamentosHoje }}
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Dívidas Liquidadas</p>
            <h2 class="text-xl font-bold text-slate-800">
                {{ $dividasLiquidadas }}
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <p class="text-sm text-slate-500">Saldo em Aberto</p>
            <h2 class="text-xl font-bold text-red-600">
                {{ number_format($saldoAberto,2,',','.') }} Kz
            </h2>
        </div>

    </div>

    <!-- LISTA -->

    <div class="space-y-4">

        @forelse($pagamentos as $pagamento)

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                <div class="flex justify-between items-start mb-4">

                    <div>

                        <h2 class="font-bold text-lg text-slate-800">

                            {{ $pagamento->divida->venda->cliente->nome ?? 'Cliente' }}

                        </h2>

                        <p class="text-sm text-slate-500">

                            Cliente ID:
                            {{ $pagamento->divida->venda->cliente->id ?? '-' }}

                        </p>

                    </div>

                    <div class="text-right">

                        <p class="font-bold text-green-600 text-lg">

                            {{ number_format($pagamento->valor,2,',','.') }} Kz

                        </p>

                        <p class="text-xs text-slate-500">

                            {{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}

                        </p>

                    </div>

                </div>

                <div class="grid md:grid-cols-3 gap-4 text-sm">

                    <div>

                        <p><strong>Telefone:</strong></p>
                        <p>{{ $pagamento->divida->venda->cliente->telefone ?? '-' }}</p>

                    </div>

                    <div>

                        <p><strong>BI:</strong></p>
                        <p>{{ $pagamento->divida->venda->cliente->bi ?? '-' }}</p>

                    </div>
                    
                    <a
    href="{{ route('pagamentos.recibo', $pagamento->id) }}"
    class="px-3 py-2 border rounded-lg">

    Ver Recibo

</a>

                    <div>

                        <p><strong>Endereço:</strong></p>
                        <p>{{ $pagamento->divida->venda->cliente->endereco ?? '-' }}</p>

                    </div>

                </div>

                <div class="grid md:grid-cols-4 gap-4 mt-6">

                    <div>
                        <p class="text-slate-500 text-xs">
                            Dívida Total
                        </p>

                        <p class="font-semibold">
                            {{ number_format($pagamento->divida->valor_total,2,',','.') }} Kz
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500 text-xs">
                            Total Pago
                        </p>

                        <p class="font-semibold">
                            {{ number_format($pagamento->divida->valor_pago,2,',','.') }} Kz
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500 text-xs">
                            Saldo Atual
                        </p>

                        <p class="font-semibold text-red-600">
                            {{ number_format($pagamento->divida->saldo,2,',','.') }} Kz
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500 text-xs">
                            Estado
                        </p>

                        <p class="font-semibold">
                            {{ $pagamento->divida->estado }}
                        </p>
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white border rounded-2xl p-10 text-center">

                <h2 class="font-semibold text-slate-700">
                    Nenhum pagamento registado
                </h2>

            </div>

        @endforelse

    </div>

</div>

</x-layouts::app>