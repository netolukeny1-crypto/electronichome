<x-layouts::app :title="'Novo Pagamento'">

<div class="max-w-3xl mx-auto p-6">

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <!-- TÍTULO -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">
                Registar Pagamento
            </h1>

            <p class="text-slate-500 text-sm">
                Preencha os dados abaixo para registar o pagamento da dívida
            </p>
        </div>

        <form method="POST" action="{{ route('pagamentos.store') }}">
            @csrf

            <!-- DÍVIDA -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Dívida
                </label>

                <select name="divida_id"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:ring focus:ring-slate-200">

                    @foreach($dividas as $divida)

                        <option value="{{ $divida->id }}">
                            Dívida #{{ $divida->id }} - Saldo: {{ number_format($divida->saldo,2,',','.') }} Kz
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- VALOR -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Valor do Pagamento
                </label>

                <input type="number"
                       name="valor"
                       step="0.01"
                       class="w-full border border-slate-300 rounded-xl p-3 focus:ring focus:ring-slate-200"
                       placeholder="Ex: 50000">

            </div>

            <!-- MÉTODO -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Método de Pagamento
                </label>

                <select name="metodo_pagamento"
                        class="w-full border border-slate-300 rounded-xl p-3 focus:ring focus:ring-slate-200">

                    <option value="Numerário">Numerário</option>
                    <option value="Transferência">Transferência Bancária</option>
                    <option value="TPA">TPA</option>
                    <option value="Multicaixa Express">Multicaixa Express</option>

                </select>

            </div>

            <!-- OBSERVAÇÃO -->
            <div class="mb-6">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Observação (opcional)
                </label>

                <textarea name="observacao"
                          rows="3"
                          class="w-full border border-slate-300 rounded-xl p-3 focus:ring focus:ring-slate-200"
                          placeholder="Ex: Cliente pagou parte da dívida..."></textarea>

            </div>

            <!-- BOTÃO -->
            <button type="submit"
                    class="w-full bg-slate-800 hover:bg-slate-900 text-white py-3 rounded-xl transition">

                Registar Pagamento

            </button>

        </form>

    </div>

</div>

</x-layouts::app>