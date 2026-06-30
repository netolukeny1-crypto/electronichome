<x-layouts::app :title="'Dashboard - ElectronicHome'">

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">
                ElectronicHome - Dashboard
            </h1>

            <p class="text-slate-500 mt-1">
                Visão geral do sistema de gestão
            </p>
        </div>

        <!-- CARD CLIENTES -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Clientes</p>
                    <h2 class="text-3xl font-semibold text-slate-800 mt-1">
                        {{ $totalClientes }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- CARD PRODUTOS -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Produtos</p>
                    <h2 class="text-3xl font-semibold text-slate-800 mt-1">
                        {{ $totalProdutos }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- CARD DÍVIDAS PENDENTES -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Dívidas Pendentes</p>
                    <h2 class="text-3xl font-semibold text-red-600 mt-1">
                        {{ $totalDividasPendentes }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- CARD DÍVIDAS PARCIAIS -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Dívidas Parciais</p>
                    <h2 class="text-3xl font-semibold text-yellow-600 mt-1">
                        {{ $totalDividasParciais }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- CARD DÍVIDAS LIQUIDADAS -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Dívidas Liquidadas</p>
                    <h2 class="text-3xl font-semibold text-green-600 mt-1">
                        {{ $totalDividasLiquidadas }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- CARD PAGAMENTOS -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm w-full">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-slate-500 text-sm">Pagamentos Recebidos</p>
                    <h2 class="text-3xl font-semibold text-slate-800 mt-1">
                        {{ number_format($pagamentosRecebidos, 2, ',', '.') }} Kz
                    </h2>
                </div>
            </div>
        </div>

        <!-- RESUMO -->
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-6">
            <p class="text-slate-600 text-sm">
                Sistema ElectronicHome ativo. Monitorização de clientes, produtos, dívidas e pagamentos em tempo real.
            </p>
        </div>

    </div>

</x-layouts::app>