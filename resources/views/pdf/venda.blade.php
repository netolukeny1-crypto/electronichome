<h1>Recibo de Venda</h1>

<p>Cliente: {{ $venda->cliente->nome }}</p>
<p>Produto: {{ $venda->produto->nome }}</p>
<p>Quantidade: {{ $venda->quantidade }}</p>
<p>Total: {{ $venda->valor_total }}</p>