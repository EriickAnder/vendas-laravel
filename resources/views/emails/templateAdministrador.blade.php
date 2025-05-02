<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas</title>
</head>

<body>
    <h1>Olá, {{ $dados['nome'] ?? 'Administrador' }}</h1>
    <p>Relatório de vendas do dia:</p>

    <ul>
        <li><strong>Total de vendas:</strong> {{ $dados['quantidade'] }}</li>
        <li><strong>Valor total das vendas:</strong> R$ {{ number_format($dados['total'], 2, ',', '.') }}</li>
        <li><strong>Comissão gerada:</strong> R$ {{ number_format($dados['comissoesGeradas'], 2, ',', '.') }}</li>
    </ul>

    <h3>Detalhamento das Vendas:</h3>
    <ul>
        @foreach ($dados['vendas'] as $venda)
            <li>
                <strong>ID da venda:</strong> {{ $venda['uuid'] }}<br>
                <strong>Valor:</strong> R$ {{ number_format($venda['valor'], 2, ',', '.') }}<br>
                <strong>Data:</strong> {{ \Carbon\Carbon::parse($venda['created_at'])->format('d/m/Y H:i') }}
            </li>
        @endforeach
    </ul>


</body>

</html>
