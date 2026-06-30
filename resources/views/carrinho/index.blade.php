<x-layouts::app :title="'Carrinho - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Carrinho de Compras
            </h1>

            <p class="text-slate-500">
                Revise os produtos antes de finalizar a venda
            </p>
        </div>

    </div>

    @if(count($carrinho) > 0)

        @php
            $total = 0;
        @endphp

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left p-4">Produto</th>
                        <th class="text-center p-4">Quantidade</th>
                        <th class="text-center p-4">Preço</th>
                        <th class="text-center p-4">Subtotal</th>
                        <th class="text-center p-4">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($carrinho as $id => $item)

                        @php
                            $subtotal = $item['preco'] * $item['quantidade'];
                            $total += $subtotal;
                        @endphp

                        <tr class="border-t">

                            <td class="p-4">
                                <div class="flex items-center gap-4">

                                    @if(!empty($item['imagem']))
                                        <img src="{{ asset('img/'.$item['imagem']) }}"
                                             class="w-20 h-20 object-cover rounded-lg border">
                                    @endif

                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            {{ $item['nome'] }}
                                        </h3>
                                    </div>

                                </div>
                            </td>

                            <td class="p-4 text-center">
                                <div class="flex justify-center items-center gap-2">

                                    <a href="{{ route('carrinho.diminuir', $id) }}"
                                       class="w-8 h-8 border rounded flex items-center justify-center hover:bg-slate-100">
                                        -
                                    </a>

                                    <span class="font-semibold">
                                        {{ $item['quantidade'] }}
                                    </span>

                                    <a href="{{ route('carrinho.aumentar', $id) }}"
                                       class="w-8 h-8 border rounded flex items-center justify-center hover:bg-slate-100">
                                        +
                                    </a>

                                </div>
                            </td>

                            <td class="p-4 text-center">
                                {{ number_format($item['preco'], 2, ',', '.') }} Kz
                            </td>

                            <td class="p-4 text-center font-semibold text-emerald-600">
                                {{ number_format($subtotal, 2, ',', '.') }} Kz
                            </td>

                            <td class="p-4 text-center">
                                <a href="{{ route('carrinho.remover', $id) }}"
                                   class="px-3 py-2 border rounded hover:bg-slate-100">
                                    Remover
                                </a>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- FORMULÁRIO -->
        <div class="grid md:grid-cols-2 gap-6 mt-6">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="font-semibold text-lg mb-4">
                    Dados da Venda
                </h2>

                <form method="POST" action="{{ route('carrinho.finalizar') }}">
                    @csrf

                    <!-- CLIENTE -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium">Cliente</label>

                        <select name="cliente_id" required class="w-full border rounded-xl p-3">

                            <option value="">Selecione o cliente</option>

                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- PAGAMENTO -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium">Forma de Pagamento</label>

                        <select id="forma_pagamento" name="forma_pagamento"
                                class="w-full border rounded-xl p-3">

                            <option value="Pré-pago">Pré-pago</option>
                            <option value="Crédito">Crédito</option>
                            <option value="Prestação">Prestação</option>

                        </select>
                    </div>

                    <!-- VALOR PAGO -->
                    <div id="campo_valor_pago" class="mb-4">
                        <label class="block mb-2 text-sm font-medium">Valor Pago</label>

                        <input type="number" name="valor_pago" value="0" step="0.01"
                               class="w-full border rounded-xl p-3">
                    </div>

                    <!-- VALOR ENTRADA (PRESTAÇÃO) -->
                    <div id="campo_entrada" class="mb-4 hidden">
                        <label class="block mb-2 text-sm font-medium">
                            Valor de Entrada (Prestação)
                        </label>

                        <input type="number" name="valor_entrada" step="0.01"
                               class="w-full border rounded-xl p-3"
                               placeholder="Digite o valor de entrada">
                    </div>

                    <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl transition">

                        Finalizar Compra
                    </button>

                </form>

            </div>

            <!-- RESUMO -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="font-semibold text-lg mb-4">Resumo</h2>

                <div class="flex justify-between py-3 border-b">
                    <span>Total de Itens</span>
                    <span>{{ count($carrinho) }}</span>
                </div>

                <div class="flex justify-between py-4">
                    <span class="font-semibold text-lg">Total Geral</span>

                    <span class="font-bold text-2xl text-emerald-600">
                        {{ number_format($total, 2, ',', '.') }} Kz
                    </span>
                </div>

            </div>

        </div>

        <!-- SCRIPT -->
        <script>
            const forma = document.getElementById('forma_pagamento');
            const entrada = document.getElementById('campo_entrada');
            const pago = document.getElementById('campo_valor_pago');

            function atualizarCampos() {

                if (forma.value === 'Prestação') {

                    entrada.classList.remove('hidden');
                    pago.classList.add('hidden');

                } else {

                    entrada.classList.add('hidden');
                    pago.classList.remove('hidden');
                }
            }

            forma.addEventListener('change', atualizarCampos);
            atualizarCampos();
        </script>

    @else

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-10 text-center">

            <h2 class="text-xl font-semibold text-slate-700">
                Carrinho vazio
            </h2>

            <p class="text-slate-500 mt-2">
                Adicione produtos ao carrinho para iniciar uma venda.
            </p>

        </div>

    @endif

</div>

</x-layouts::app>