<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura ElectronicHome</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            color: #1a1a1a;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #f5f5f5;
            padding: 8px;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <h1>ElectronicHome</h1>
        <p>Sistema de Gestão de Vendas</p>
    </div>

    {{-- INFO CLIENTE --}}
    <div class="info">
        <p><strong>Cliente:</strong> {{ $venda->cliente->nome }}</p>
        <p><strong>Data:</strong> {{ $venda->created_at }}</p>
        <p><strong>Venda ID:</strong> #{{ $venda->id }}</p>
    </div>

    {{-- TABELA --}}
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($venda->itens as $item)
            <tr>
                <td>{{ $item->produto->nome }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>{{ number_format($item->preco_unitario, 2, ',', '.') }} Kz</td>
                <td>{{ number_format($item->subtotal, 2, ',', '.') }} Kz</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total">
        Total: {{ number_format($venda->valor_total, 2, ',', '.') }} Kz
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Obrigado por comprar na ElectronicHome
    </div>

</body>
</html>