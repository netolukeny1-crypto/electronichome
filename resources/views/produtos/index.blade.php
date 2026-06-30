<x-layouts::app :title="'Produtos - ElectronicHome'">

<div class="max-w-7xl mx-auto p-6">

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1>Produtos</h1>

    <a href="{{ route('produtos.create') }}"
       style="background:#16a34a; color:white; padding:10px 15px; border-radius:8px; text-decoration:none;">
        + Novo Produto
    </a>
</div>

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-800">
            Catálogo de Produtos
        </h1>
        <p class="text-slate-500 mt-1">
            Explore os produtos disponíveis na ElectronicHome
        </p>
    </div>

    <!-- PESQUISA -->
    <form method="GET" class="mb-6">
        <input type="text"
               name="pesquisa"
               value="{{ request('pesquisa') }}"
               placeholder="Pesquisar produto..."
               class="border p-3 rounded-xl w-full shadow-sm focus:ring-2 focus:ring-emerald-500">
    </form>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($produtos as $produto)

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">

                <!-- IMAGEM -->
                <div class="h-48 bg-slate-100 relative">

                    @if($produto->imagem)
                        <img src="{{ asset('img/' . $produto->imagem) }}"
                             class="w-full h-full object-cover">
                    @else
                        class="w-full h-full object-cover transition duration-300 hover:scale-105"
                            Sem imagem
                        </div>
                    @endif

                    <div class="absolute top-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                        {{ $produto->categoria }}
                    </div>

                </div>

                <!-- CONTEÚDO -->
                <div class="p-4 flex flex-col flex-1">

                    <h2 class="font-semibold text-slate-800">
                        {{ $produto->nome }}
                    </h2>

                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                        {{ $produto->descricao ?? 'Produto eletrónico de qualidade.' }}
                    </p>

                    <!-- STOCK -->
                    <div class="mt-3">
                        @if($produto->stock <= 0)
                            <span class="text-xs text-red-600 font-semibold">Esgotado</span>
                        @elseif($produto->stock <= 5)
                            <span class="text-xs text-red-500 font-semibold">
                                Stock baixo: {{ $produto->stock }}
                            </span>
                        @else
                            <span class="text-xs text-slate-500">
                                Stock: {{ $produto->stock }}
                            </span>
                        @endif
                    </div>

                    <!-- PREÇO -->
                    <div class="mt-auto pt-4 flex justify-between items-center">

                        <span class="text-green-600 font-bold text-lg">
                            {{ number_format($produto->preco, 2, ',', '.') }} Kz
                        </span>

                    </div>

                    <!-- BOTÃO -->
                    @if($produto->stock > 0)
                        <a href="{{ route('carrinho.adicionar', $produto->id) }}"
                           class="mt-3 w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm py-2 rounded-lg transition">
                            Adicionar ao carrinho
                        </a>
                    @else
                        <button disabled
                                class="mt-3 w-full bg-slate-300 text-slate-600 text-sm py-2 rounded-lg cursor-not-allowed">
                            Indisponível
                        </button>
                    @endif

                </div>

            </div>

        @empty

            <div class="col-span-4 text-center text-slate-500">
                Nenhum produto encontrado.
            </div>

        @endforelse

    </div>

    <!-- PAGINAÇÃO BONITA -->
    <div class="mt-8 flex justify-center">
        <div class="bg-white px-4 py-2 rounded-xl shadow border">
            {{ $produtos->withQueryString()->links() }}
        </div>
    </div>

</div>

</x-layouts::app>