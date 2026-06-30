<x-layouts::app :title="'Novo Cliente - ElectronicHome'">

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

        <!-- Cabeçalho -->
        <div class="border-b border-slate-200 p-6">

            <h1 class="text-2xl font-bold text-slate-800">
                Novo Cliente
            </h1>

            <p class="text-slate-500 mt-1">
                Registo de clientes da ElectronicHome
            </p>

        </div>

        <!-- Formulário -->
        <form method="POST"
              action="{{ route('clientes.store') }}"
              class="p-6">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nome -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nome Completo
                    </label>

                    <input
                        type="text"
                        name="nome"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Telefone -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Telefone
                    </label>

                    <input
                        type="text"
                        name="telefone"
                        required
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- BI -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Número do BI
                    </label>

                    <input
                        type="text"
                        name="bi"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Endereço -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Endereço
                    </label>

                    <input
                        type="text"
                        name="endereco"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

            </div>

            <!-- Botões -->
            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('clientes.index') }}"
                   class="px-5 py-3 border border-slate-300 rounded-xl text-slate-700 hover:bg-slate-100 transition">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">

                    Guardar Cliente

                </button>

            </div>

        </form>

    </div>

</div>

</x-layouts::app>
