<x-layouts::app :title="'Dívidas - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold text-slate-800 mb-6">
        Gestão de Dívidas
    </h1>

    <div class="grid gap-6">

        @foreach($dividas as $divida)

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <!-- HEADER -->
                <div class="flex justify-between items-start mb-4">

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            {{ $divida->venda->cliente->nome ?? 'Cliente não encontrado' }}
                        </h2>

                        <p class="text-sm text-slate-500">
                            Venda #{{ $divida->venda_id }} • {{ $divida->created_at }}
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($divida->estado == 'Liquidada') bg-green-100 text-green-700
                        @elseif($divida->estado == 'Parcial') bg-yellow-100 text-yellow-700
                        @else bg-red-100 text-red-700 @endif">

                        {{ $divida->estado }}

                    </span>

                </div>

                <!-- INFO GRID -->
                <div class="grid md:grid-cols-2 gap-4 text-sm">

                    <!-- CLIENTE -->
                    <div class="bg-slate-50 p-4 rounded-xl">
                        <p class="font-semibold text-slate-700 mb-2">Cliente</p>

                        <p>{{ $divida->venda->cliente->telefone ?? '-' }}</p>
                        <p>{{ $divida->venda->cliente->endereco ?? '-' }}</p>
                        <p>{{ $divida->venda->cliente->bi ?? '-' }}</p>
                    </div>

                    <!-- FINANCEIRO -->
                    <div class="bg-slate-50 p-4 rounded-xl">
                        <p class="font-semibold text-slate-700 mb-2">Financeiro</p>

                        <p>Total: <strong>{{ number_format($divida->valor_total, 2, ',', '.') }} Kz</strong></p>
                        <p>Pago: {{ number_format($divida->valor_pago, 2, ',', '.') }} Kz</p>
                        <p>Saldo: <strong class="text-red-600">
                            {{ number_format($divida->saldo, 2, ',', '.') }} Kz
                        </strong></p>
                    </div>

                </div>

                <!-- FOOTER INFO -->
                <div class="mt-4 text-sm text-slate-500 flex justify-between">

                    <span>
                        Atendido por: {{ auth()->user()->name ?? 'Admin' }}
                    </span>

                    <span>
                        Data: {{ $divida->created_at }}
                    </span>

                </div>

            </div>

        @endforeach

    </div>

</div>

</x-layouts::app>