<x-layouts::app :title="'Editar Cliente'">

<div class="max-w-4xl mx-auto p-6">

    <!-- CABEÇALHO -->
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-slate-800">
            Editar Cliente
        </h1>

        <p class="text-slate-500 mt-1">
            Atualize as informações do cliente registado no sistema.
        </p>

    </div>

    <!-- FORMULÁRIO -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

        <form method="POST" action="{{ route('clientes.update', $cliente) }}">

            @csrf
            @method('PUT')

            <!-- NOME -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nome Completo
                </label>

                <input
                    type="text"
                    name="nome"
                    value="{{ $cliente->nome }}"
                    required
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >

            </div>

            <!-- TELEFONE -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Telefone
                </label>

                <input
                    type="text"
                    name="telefone"
                    value="{{ $cliente->telefone }}"
                    required
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >

            </div>

            <!-- BI -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Bilhete de Identidade
                </label>

                <input
                    type="text"
                    name="bi"
                    value="{{ $cliente->bi }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >

            </div>

            <!-- ENDEREÇO -->
            <div class="mb-8">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Endereço
                </label>

                <input
                    type="text"
                    name="endereco"
                    value="{{ $cliente->endereco }}"
                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                >

            </div>

            <!-- BOTÕES -->
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl transition">

                    Atualizar Cliente

                </button>

                <a
                    href="{{ route('clientes.index') }}"
                    class="border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 px-6 py-3 rounded-xl transition">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

</x-layouts::app>