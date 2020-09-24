Documentação Wallet-transfer

Comandos do Docker

Rodar os containers:
docker-compose up

Listar containers:
docker ps

Parar os containers:
docker-compose up

Após subir os containers, execute o comando na raiz do projeto
composer install
para instalar as dependências.

Após instalar as dependências, acesse a pasta do container
cd docker

Para enviar comandos ao Laravel (container wallet) é necessário informar ao Docker qual container receberá as informações. Para isso, basta inserir o prefixo abaixo e em seguida o comando desejado.

Enviar um comando para o Laravel:
docker exec wallet [foo]


Aqui você precisará rodar as migrações para ter o banco de dados do projeto.

Exemplo para rodar as migrações:
docker exec wallet php artisan migrate:fresh

Após rodar as migrações é necessária popular o banco. Para fazer isso, iremos usar o artisan mais uma vez usando o comando abaixo.

Exemplo para rodar as Seeds criadas do BD:
docker exec wallet php artisan db:seed

Exemplos de comandos úteis
Exemplo para criar migrações
docker exec wallet php artisan make:migration create_foos_table

Exemplo para criar as models:
docker exec wallet php artisan make:model Foo

Exemplo para dar rollback nas Migrações executadas:
docker exec wallet php artisan migrate:reset



Postman
O nginx do container foi configurado para rodar na porta 80.
O BD está usando a porta padrão do MySQL, 3306.

Abaixo segue um exemplo de requisição para a API do projeto.
Método: POST 
Endpoint: localhost:80/api/transaction
JSON com o payload: 
{
    "value" : 100.00,
    "payer" : 4,
    "payee" : 15
}

Retorno:
{
    "message" : "Transação realizada com sucesso."
}

Funcionamento

A aplicação irá receber a requisição Http no endpoint api/transaction e enviar para o controller TransactionController. Após receber os dados, o controller irá validar o paylod para garantir a integridade dos dados recebidos. Após a sanitização dos dados, o payload é enviado para o TransactionService.
No TransactionService são injetadas as dependências que serão usadas para realizar as tarefas.
Serviço de validação: ValidationService
Serviço do usuário: UserService
Model da transação: Transaction;

Dentro do serviço da transação, o primeiro passo é validar as regras de negócio que foram estabelecidas.
Para isso, chamamos o método 
verifyTransaction($request)
que recebe o payload da transação.
Dentro deste método, temos 3 funções que estendem outras classes e irão validar:
1º - O Tipo do usuário, pois usuários do tipo PJ não podem enviar dinheiro para outros usuários.

2º - O Saldo do usuário, pois é necessário ter a quantia enviada para efetuar a transação.

3º - Um serviço externo, que no caso é um mock, mas pode ser adaptado para um serviço externo que necessite autorizar a transação.

Caso a requisição não atende algum dos requisitos acima, uma exception é lançada com a descrição da validação.

Caso a requisição atenda todas as validações, o método 
updateCustomersBalance($request)
é chamado. O método está implementado na classe UserService que foi injetada.
O método é chamado com os parâmetros da request e ele é responsável por subtrair o valor do pagador e enviar o valor para o recebedor. Após isso, é feita a gravação dos dados no banco e retornamos para o TransactionService.
Após tudo dar certo na atualização dos valores, verificamos novamente o mock externo para verificar se o valor foi enviado e salvamos a transação na tabela “Transaction” do BD.
