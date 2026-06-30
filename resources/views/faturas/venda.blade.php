<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura - ElectronicHome</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            font-size: 12px;
            color: #111827;
        }

        .invoice {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #9ca3af;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
        }

        .invoice-id {
            text-align: right;
        }

        .invoice-id h2 {
            margin: 0;
            font-size: 16px;
            color: #111827;
        }

        .meta {
            color: #6b7280;
            font-size: 11px;
        }

        /* GRID */
        .grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .box {
            width: 48%;
            background: #f9fafb;
            padding: 10px;
            border-radius: 6px;
        }

        .title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #374151;
            font-size: 11px;
        }

        .client-name {
            font-size: 14px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 4px;
        }

        .client-info {
            color: #374151;
            margin: 2px 0;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #6b7280;
            color: white;
            padding: 8px;
            font-size: 11px;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
            color: #111827;
        }

        /* TOTAL */
        .total {
            text-align: right;
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            color: #111827;
        }

        /* FOOTER */
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
    </style>
</head>

<body>

<div class="invoice">

    <!-- HEADER -->
    <div class="header">

        <div>
            <div class="brand">ElectronicHome</div>
            <div class="meta">Sistema de Gestão Comercial</div>
        </div>

        <div class="invoice-id">
            <h2>FATURA</h2>
            <div class="meta">
                Nº: {{ $venda->numero_fatura ?? ('EH-'.$venda->id) }}
            </div>
            <div class="meta">
                Data: {{ $venda->created_at }}
            </div>
        </div>

    </div>

    <!-- INFO -->
    <div class="grid">

        <!-- CLIENTE -->
        <div class="box">
            <div class="title">CLIENTE</div>

            <div class="client-name">
                {{ $venda->cliente->nome ?? 'N/A' }}
            </div>

            <div class="client-info">
                Telefone: {{ $venda->cliente->telefone ?? 'N/A' }}
            </div>

            <div class="client-info">
                BI: {{ $venda->cliente->bi ?? 'N/A' }}
            </div>

            <div class="client-info">
                Endereço: {{ $venda->cliente->endereco ?? 'N/A' }}
            </div>
        </div>

        <!-- VENDA -->
        <div class="box">
            <div class="title">VENDA</div>

            <p>Pagamento: {{ $venda->forma_pagamento }}</p>
            <p>Atendido por: {{ auth()->user()->name ?? 'Admin' }}</p>
           <div class="total">

    <p>
        Total dos Produtos:
        {{ number_format($venda->valor_total, 2, ',', '.') }} Kz
    </p>

    @if($venda->forma_pagamento == 'Prestação' && $venda->divida)

        <p>
            1ª Entrada:
            {{ number_format($venda->divida->valor_pago, 2, ',', '.') }} Kz
        </p>

        <p>
            Saldo em Dívida:
            {{ number_format($venda->divida->saldo, 2, ',', '.') }} Kz
        </p>

    @endif

</div>

@if($venda->divida && $venda->divida->pagamentos->count())

<hr>

<h3>Histórico de Pagamentos</h3>

<table>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>

        @foreach($venda->divida->pagamentos as $pagamento)

            <tr>

                <td>
                    {{ $pagamento->tipo }}
                </td>

                <td>
                    {{ number_format($pagamento->valor, 2, ',', '.') }} Kz
                </td>

                <td>
                    {{ $pagamento->created_at->format('d/m/Y H:i') }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

@endif

    </div>

    <!-- PRODUTOS -->
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Preço</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($venda->itens as $item)
                <tr>
                    <td>{{ $item->produto->nome }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>{{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                    <td>{{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="total">
        TOTAL GERAL: {{ number_format($venda->valor_total, 2, ',', '.') }} Kz
    </div>

    <!-- FOOTER -->
    <div class="footer">
        ElectronicHome ERP - Documento processado automaticamente
    </div>

</div>

</body>
</html>