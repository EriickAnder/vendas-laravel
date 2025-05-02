<h1>Olá, {{ $dados['nome'] }}</h1>
<p>Relatório de vendas do dia:</p>
<ul>
    <li>Total de vendas: {{ count($dados['vendas']) }}</li>
    <li>Valor total: R$ {{ number_format($dados['total_vendas'], 2, ',', '.') }}</li>
    <li>Comissão: R$ {{ number_format($dados['comissao'], 2, ',', '.') }}</li>
</ul>
