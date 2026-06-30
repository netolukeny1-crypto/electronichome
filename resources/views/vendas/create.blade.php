<h1>Nova Venda</h1>

@if(session('erro'))
    <p style="color:red">{{ session('erro') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('vendas.store') }}">
    @csrf

    {{-- CLIENTE --}}
    <label>Cliente</label>
    <select name="cliente_id" required>
        @foreach(\App\Models\Cliente::all() as $cliente)
            <option value="{{ $cliente->id }}">
                {{ $cliente->nome }}
            </option>
        @endforeach
    </select>

    <br><br>

    {{-- CARRINHO --}}
    <h3>Produtos</h3>

    <div id="carrinho">

        {{-- ITEM INICIAL --}}
        <div class="produto-item">
            <label>Produto</label>
            <select name="produtos[]" required>
                @foreach(\App\Models\Produto::all() as $produto)
                    <option value="{{ $produto->id }}">
                        {{ $produto->nome }} - {{ $produto->preco }} Kz (Stock: {{ $produto->stock }})
                    </option>
                @endforeach
            </select>

            <label>Quantidade</label>
            <input type="number" name="quantidades[]" min="1" value="1" required>

            <button type="button" onclick="removerProduto(this)">
                ❌ Remover
            </button>
        </div>

    </div>

    <br>

    <button type="button" onclick="adicionarProduto()">
        + Adicionar outro produto
    </button>

    <br><br>

    {{-- PAGAMENTO --}}
    <label>Forma de Pagamento</label>
    <select name="forma_pagamento" id="formaPagamento" required>
        <option value="Pré-pago">Pré-pago</option>
        <option value="Crédito">Crédito</option>
        <option value="Prestação">Prestação</option>
    </select>

    <br><br>

    {{-- ENTRADA --}}
    <div id="entradaDiv" style="display:none;">
        <label>Valor de Entrada</label>
        <input type="number" name="valor_pago" placeholder="Valor de entrada">
    </div>

    <br><br>

    <button type="submit">Registar Venda</button>
</form>

<script>
const formaPagamento = document.getElementById('formaPagamento');
const entradaDiv = document.getElementById('entradaDiv');

formaPagamento.addEventListener('change', function () {
    entradaDiv.style.display = (this.value === 'Prestação') ? 'block' : 'none';
});


// 🔥 ADICIONAR PRODUTO
function adicionarProduto() {

    let container = document.getElementById('carrinho');

    let html = `
        <div class="produto-item" style="margin-top:10px;">
            <label>Produto</label>
            <select name="produtos[]" required>
                @foreach(\App\Models\Produto::all() as $produto)
                    <option value="{{ $produto->id }}">
                        {{ $produto->nome }} - {{ $produto->preco }} Kz (Stock: {{ $produto->stock }})
                    </option>
                @endforeach
            </select>

            <label>Quantidade</label>
            <input type="number" name="quantidades[]" min="1" value="1" required>

            <button type="button" onclick="removerProduto(this)">
                ❌ Remover
            </button>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
}


// 🔥 REMOVER PRODUTO
function removerProduto(btn) {
    btn.parentElement.remove();
}
</script>