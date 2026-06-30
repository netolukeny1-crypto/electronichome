<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo - ElectronicHome</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 20px;
            font-size: 12px;
            color: #111;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
        }

        .header {
            border-bottom: 2px solid #6b7280;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
        }

        .recibo-num {
            margin-top: 5px;
            color: #6b7280;
        }

        .section {
            margin-bottom: 15px;
        }

        .title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #374151;
        }

        .box {
            background: #f9fafb;
            padding: 10px;
            border-radius: 6px;
        }

        .value {
            font-weight: bold;
            color: #111;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="brand">
            ElectronicHome
        </div>

        <div class="recibo-num">
            Recibo Nº: {{ $pagamento->numero_recibo ?? ('REC-'.$pagamento->id) }}
        </div>

    </div>

    <!-- CLIENTE -->
    <div class="section">

        <div class="title">DADOS DO CLIENTE</div>

        <div class="box">

            <p><strong>Nome:</strong> {{ $pagamento->divida->venda->cliente->nome ?? '-' }}</p>

            <p><strong>Telefone:</strong> {{ $pagamento->divida->venda->cliente->telefone ?? '-' }}</p>

            <p><strong>BI:</strong> {{ $pagamento->divida->venda->cliente->bi ?? '-' }}</p>

            <p><strong>Endereço:</strong> {{ $pagamento->divida->venda->cliente->endereco ?? '-' }}</p>

        </div>

    </div>

    <!-- PAGAMENTO -->
    <div class="section">

        <div class="title">DADOS DO PAGAMENTO</div>

        <div class="box">

            <p><strong>Valor Pago:</strong>
                <span class="value">
                    {{ number_format($pagamento->valor,2,',','.') }} Kz
                </span>
            </p>

            <p><strong>Data:</strong>
                {{ $pagamento->data_pagamento }}
            </p>

            <p><strong>Método:</strong>
                {{ $pagamento->metodo_pagamento ?? 'Não definido' }}
            </p>

            <p><strong>Funcionário:</strong>
                {{ $pagamento->user->name ?? 'Admin' }}
            </p>

        </div>

    </div>

</div>

</body>
</html>