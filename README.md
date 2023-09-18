# PermissionsManage
Projeto com sistema de login e com gerenciamento de permissões entre usuário e visualização de determinadas telas em que o usuário tenha a permissão.
Realizado TDD e Teste de integração do controlador User.

# Descrição build
Projeto criado atravez do framework Laravel v9.19 *estável junto com Vue js. v3,
utilizando a lib. de permissões spatie/laravel-permission v5.11,
uara estilização foi usado Bootstrap 5,
banco de dados MySQL.

*Necessita ter o PHP v8, NodeJs 14 e NPM 6*

# Start do Projeto

*composer install*

*npm install* 

ajustar DB no arquivo .env

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=db-name

DB_USERNAME=db-username

DB_PASSWORD=db-password


*php artisan migrate*

*php artisan db:seed*

*php artisan key:generate*

*php artisan serve*

*npm run dev*

# Usuários para teste

email: administrador@autogestor.com
senha: password

email: comum@autogestor.com
senha: password
Contem a somente a permissão de *Produtos

email: comum1@autogestor.com
senha: password
Contem a somente a permissão de *Produtos e Categoria

email: comum2@autogestor.com
senha: password
Contem a somente a permissão de *Produtos, Categoria e Marcas
