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



OBS: Não implementei testes devido ao tempo que consegui separar. Caso queira, posso adicionar um commit com os testes unitários
OBS: Iniciei a implementação do redis na listagem das vendas, mas devido ao tempo não adicionei nesse commit.
OBS: queue - Estou utilizando o proprio laravel, mas caso queira posso implementar o rabbitMQ
OBS: Envio de e-mail / Deixei programado para enviar com fila tanto no envio manual quanto com jobs

********************START PROJETO********************

*Passo 1:*
docker-compose build

*Passo 2:*
docker-compose up -d

*Passo 3:*
 Entre no container
docker exec -it laravel_vendas bash

*Passo 4:*
composer install ;)

*Passo 5:*
Crie um database chamado vendas
*ATUALIZAR O ENV PARA AS CREDENCIAIS DO BANCO CRIADO *
Credenciais Padrão:
DB_DATABASE=vendas
DB_USERNAME=root
DB_PASSWORD=root

*Passo 6:*
php artisan migrate

*Passo 7:*
php artisan db:seed


-----------------------------------

* Comando para startar a fila de jobs *
php artisan queue:work
( é necessário rodar dentro do bash do terminal docker [docker exec -it laravel_vendas bash])


------------------------------------

Usuário criado no seed para consumo da api:
User: eriickanderson@gmail.com
Pass: 123456

Url base: 127.0.0.1:8000/api/
 # Para rodar o job no horário é necessario adicionar no cron do servidor
 #   * * * * * php /caminho/para/seu/projeto/artisan schedule:run >> /dev/null 2>&1
