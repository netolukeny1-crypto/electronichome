<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gray-100 text-gray-900">

    <!-- SIDEBAR -->
    <flux:sidebar
        sticky
        collapsible="mobile"
        class="border-e border-slate-300 bg-blue-800 text-white">

        <flux:sidebar.header>

            <div class="text-center w-full py-3">
                <h1 class="text-xl font-bold text-white">
                    ElectronicHome
                </h1>

                <p class="text-xs text-blue-200">
                    Sistema de Gestão Comercial
                </p>
            </div>

            <flux:sidebar.collapse class="lg:hidden" />

        </flux:sidebar.header>

        <flux:sidebar.nav>

            <flux:sidebar.group heading="MENU">

                <flux:sidebar.item
                    icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')">
                    Dashboard
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="users"
                    href="{{ url('/clientes') }}">
                    Clientes
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="folder"
                    href="{{ url('/produtos') }}">
                    Produtos
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="shopping-cart"
                    href="{{ url('/vendas/create') }}">
                    Vendas
                </flux:sidebar.item>

                <flux:sidebar.item
                icon="shopping-cart"
                href="{{ route('carrinho.index') }}">
                Carrinho
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="credit-card"
                    href="{{ url('/pagamentos') }}">
                    Pagamentos
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="document"
                    href="{{ url('/dividas') }}">
                    Dívidas
                </flux:sidebar.item>

            </flux:sidebar.group>

        </flux:sidebar.nav>

        <flux:spacer />

        @auth

    <div class="p-4 border-t border-blue-700">

        <div class="text-sm text-blue-100">
            Utilizador
        </div>

        <div class="font-semibold text-white mb-4">
            {{ auth()->user()->name }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-200 shadow">

                🚪 Sair

            </button>
        </form>

    </div>

@endauth

    </flux:sidebar>

    <!-- HEADER MOBILE -->
    <flux:header class="lg:hidden bg-white shadow-sm">

        <flux:sidebar.toggle
            class="lg:hidden"
            icon="bars-2"
            inset="left" />

        <flux:spacer />

        <h1 class="font-bold text-blue-700">
            ElectronicHome
        </h1>

    </flux:header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="p-6">

        <div class="max-w-7xl mx-auto">

            <div class="bg-white rounded-xl shadow-md p-6">

                {{ $slot }}

            </div>

        </div>

    </main>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>
</html>