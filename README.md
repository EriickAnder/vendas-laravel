API

 [x] - Cadastrar Vendedores ( Nome, Email)
 [x] - Cadastrar Venda ( Vendedor, valor, data da venda)

 [x] - Listar Vendedores ( Paginação e filtro de data)
 [x] - Listar vendas ( Paginação e filtro de data)
 [x] - Listar todas as vendas por vendedor ( Paginação e filtro de data)


 [x] - Autenticação API
 [x] - Calcular COmissoes por vendedor
 [x] - Envio de E- mail Vendedor
 [x] - Envio de E- mail Administrador


Ações: 
 [x] - Enviar um e-mail para o vendedor ao final de cada dia com a quantidade de vendas
realizadas no dia, o valor total delas e o valor total das comissão;
 [x] - Enviar um e-mail para o administrador do sistema contendo todas a soma de todas as
vendas efetuadas no dia;
 [x] - Permitir que o administrador reenvie o e-mail de comissão a um determinado
vendedor;


Filas: Envio de e-mail / Deixei programado para enviar com fila tanto no envio manual quanto com jobs


Rodar seed : php artisan db:seed

 # Para rodar o job no horário é necessario adicionar no cron do servidor
 #   * * * * * php /caminho/para/seu/projeto/artisan schedule:run >> /dev/null 2>&1
