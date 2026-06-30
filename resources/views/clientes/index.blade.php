<x-layouts::app :title="'Clientes - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">Clientes</h1>
            <p class="text-slate-500 mt-1">Gestão de clientes registados</p>
        </div>

        <a href="{{ route('clientes.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 rounded-xl">
            Novo Cliente
        </a>

    </div>

    <!-- PESQUISA -->
    <form method="GET" class="mb-6">
        <input type="text"
               name="pesquisa"
               value="{{ request('pesquisa') }}"
               placeholder="Pesquisar cliente..."
               class="border p-3 rounded-xl w-full shadow-sm">
    </form>

    <!-- TABELA -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left">Nome</th>
                    <th class="px-6 py-4 text-left">Telefone</th>
                    <th class="px-6 py-4 text-left">BI</th>
                    <th class="px-6 py-4 text-left">Endereço</th>
                    <th class="px-6 py-4 text-center">Ações</th>
                </tr>
            </thead>

            <tbody>

                @forelse($clientes as $cliente)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-6 py-4 font-medium">{{ $cliente->nome }}</td>
                        <td class="px-6 py-4">{{ $cliente->telefone }}</td>
                        <td class="px-6 py-4">{{ $cliente->bi ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $cliente->endereco ?? '-' }}</td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('clientes.edit', $cliente) }}"
                                   class="px-3 py-2 border rounded-lg text-sm">
                                    Editar
                                </a>

                                <form method="POST"
                                      action="{{ route('clientes.destroy', $cliente) }}"
                                      onsubmit="return confirm('Eliminar cliente?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-2 border rounded-lg text-sm">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="p-10 text-center text-slate-500">
                            Nenhum cliente encontrado.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINAÇÃO -->
    <div class="mt-6 flex justify-center">
        <div class="bg-white px-4 py-2 rounded-xl shadow border">
            {{ $clientes->withQueryString()->links() }}
        </div>
    </div>

</div>

</x-layouts::app>