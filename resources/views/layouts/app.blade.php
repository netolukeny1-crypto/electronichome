<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-slate-100 text-slate-900">

<!-- 🔥 UM ÚNICO CONTROLO ALPINE PARA TUDO -->
<div x-data="{ sidebarOpen: true, openLogout: false }" class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside
        :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="bg-slate-900 text-white transition-all duration-300 flex flex-col h-screen shadow-xl">

        <!-- LOGO + TOGGLE -->
        <div class="p-4 border-b border-slate-700 flex items-center justify-between">

            <div x-show="sidebarOpen" class="font-bold text-lg">
                ElectronicHome
            </div>

            <button @click="sidebarOpen = !sidebarOpen"
                    class="text-white text-xl hover:text-emerald-400">
                ☰
            </button>

        </div>

        <!-- MENU -->
        <nav class="flex-1 p-3 space-y-2 text-sm text-white">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                🏠 <span x-show="sidebarOpen">Dashboard</span>
            </a>

            <a href="{{ route('clientes.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                👥 <span x-show="sidebarOpen">Clientes</span>
            </a>

            <a href="{{ route('produtos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                📦 <span x-show="sidebarOpen">Produtos</span>
            </a>

            <a href="{{ route('vendas.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                🧾 <span x-show="sidebarOpen">Vendas</span>
            </a>

            <a href="{{ route('carrinho.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                🛒 <span x-show="sidebarOpen">Carrinho</span>
            </a>

            <a href="{{ route('pagamentos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                💳 <span x-show="sidebarOpen">Pagamentos</span>
            </a>

            <a href="{{ route('dividas.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-700">
                📄 <span x-show="sidebarOpen">Dívidas</span>
            </a>

        </nav>

        <!-- 🔥 FOOTER FIXO -->
        @auth
        <div class="mt-auto border-t border-slate-700 p-3">

            <div x-show="sidebarOpen" class="text-xs text-slate-400 mb-1">
                Logado como
            </div>

            <div class="font-semibold text-sm mb-3">
                {{ auth()->user()->name }}
            </div>

            <!-- BOTÃO SAIR -->
            <button
                @click="openLogout = true"
                type="button"
                class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white text-xs py-2 rounded transition">

                🚪 <span x-show="sidebarOpen">Sair</span>

            </button>

        </div>
        @endauth

    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="bg-white shadow px-6 py-3 flex items-center justify-between">

            <div class="flex items-center gap-4">

                <h2 class="font-semibold text-slate-700">
                    ElectronicHome
                </h2>

                <input type="text"
                       placeholder="Pesquisar..."
                       class="border rounded-lg px-3 py-1 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-emerald-500">

            </div>

            <div class="flex items-center gap-4">

                <button class="relative text-xl">
                    🔔
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full">
                        3
                    </span>
                </button>

                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-slate-300 rounded-full"></div>
                    <span class="text-sm">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="p-6">

            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>

        </main>

    </div>

    <!-- 🔥 MODAL LOGOUT (CORRIGIDO) -->
    <div
        x-show="openLogout"
        x-transition
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    >

        <div class="bg-white w-96 rounded-xl shadow-lg p-6">

            <h2 class="text-lg font-bold text-slate-800">
                Confirmar saída
            </h2>

            <p class="text-sm text-slate-600 mt-2">
                Tens a certeza que queres terminar a sessão?
            </p>

            <div class="flex justify-end gap-3 mt-6">

                <button
                    @click="openLogout = false"
                    class="px-4 py-2 rounded-lg bg-slate-200 hover:bg-slate-300 text-sm">

                    Cancelar
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm">

                        Sim, sair
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

<!-- Alpine -->
<script src="https://unpkg.com/alpinejs" defer></script>

</body>
</html>