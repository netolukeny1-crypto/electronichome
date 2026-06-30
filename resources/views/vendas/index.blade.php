<x-layouts::app :title="'Vendas - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-slate-800">
            Histórico de Vendas
        </h1>

        <p class="text-slate-500">
            Gestão completa das vendas realizadas
        </p>

    </div>

    <!-- DASHBOARD -->
    <div class="grid md:grid-cols-6 gap-4 mb-6">

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Total Vendido</p>
            <h2 class="font-bold text-xl text-emerald-600">
                {{ number_format($totalVendas,2,',','.') }} Kz
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Vendas Hoje</p>
            <h2 class="font-bold text-xl">
                {{ $vendasHoje }}
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Faturação Hoje</p>
            <h2 class="font-bold text-xl">
                {{ number_format($faturacaoHoje,2,',','.') }} Kz
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Ticket Médio</p>
            <h2 class="font-bold text-xl">
                {{ number_format($ticketMedio,2,',','.') }} Kz
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Canceladas</p>
            <h2 class="font-bold text-xl text-red-600">
                {{ $canceladas }}
            </h2>
        </div>

        <div class="bg-white border rounded-2xl p-4 shadow-sm">
            <p class="text-slate-500 text-sm">Clientes</p>
            <h2 class="font-bold text-xl">
                {{ $clientesAtendidos }}
            </h2>
        </div>

    </div>

    <!-- FILTROS -->
    <form method="GET" class="bg-white border rounded-2xl p-4 mb-6 shadow-sm">

        <div class="grid md:grid-cols-4 gap-4">

            <input type="text"
                   name="pesquisa"
                   value="{{ request('pesquisa') }}"
                   placeholder="Pesquisar cliente..."
                   class="border rounded-xl p-3">

            <select name="forma_pagamento" class="border rounded-xl p-3">
                <option value="">Todos Pagamentos</option>
                <option value="Pré-pago">Pré-pago</option>
                <option value="Crédito">Crédito</option>
                <option value="Prestação">Prestação</option>
            </select>

            <select name="estado" class="border rounded-xl p-3">
                <option value="">Todos Estados</option>
                <option value="Concluída">Concluída</option>
                <option value="Cancelada">Cancelada</option>
            </select>

            <button type="submit"
                    class="bg-slate-800 text-white rounded-xl py-2">
                Filtrar
            </button>

        </div>

    </form>

    <!-- TABELA -->
    <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">
                <tr>
                    <th class="p-4 text-left">Fatura</th>
                    <th class="p-4 text-left">Cliente</th>
                    <th class="p-4 text-left">Telefone</th>
                    <th class="p-4 text-left">Pagamento</th>
                    <th class="p-4 text-left">Estado</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Data</th>
                    <th class="p-4 text-left">Ações</th>
                </tr>
            </thead>

            <tbody>

            @forelse($vendas as $venda)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">
                        EH-{{ str_pad($venda->id,6,'0',STR_PAD_LEFT) }}
                    </td>

                    <td class="p-4">
                        {{ $venda->cliente->nome ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $venda->cliente->telefone ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $venda->forma_pagamento }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs
                        {{ $venda->estado === 'Cancelada'
                            ? 'bg-red-100 text-red-700'
                            : 'bg-green-100 text-green-700' }}">
                            {{ $venda->estado }}
                        </span>
                    </td>

                    <td class="p-4 font-semibold text-emerald-600">
                        {{ number_format($venda->valor_total,2,',','.') }} Kz
                    </td>

                    <td class="p-4">
                        {{ $venda->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('vendas.show',$venda->id) }}"
                               class="px-3 py-2 border rounded-lg">
                                Detalhes
                            </a>

                            <a href="{{ route('fatura.show',$venda->id) }}"
                               class="px-3 py-2 border rounded-lg">
                                Fatura
                            </a>
                        </div>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="8" class="p-10 text-center text-slate-500">
                        Nenhuma venda encontrada.
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-layouts::app>