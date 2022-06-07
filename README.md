# Apresentação

Fala devs, tudo bem? O projeto que estão analisando é um "protótipo". O mesmo foi desenvolvido com Laravel, HTML, CSS, Bootstrap 4, Javascript, jQuery e MySQL.
Também está configurado para se usar com docker (usando a estrutura laradock), mas se quiserem usar com XAMPP, sem problemas! Tudo está aqui abaixo na etapa de instalação.

O projeto consiste em uma plataforma para "gerenciar" pedidos de compra. Você pode registrar seus produtos e gerar os pedidos. Cada pedido possui os produtos e o cliente que solicitou. 
Você poderá ter um status de cada pedido com um dashboard para ter uma melhor visibilidade.

Obs.: O projeto foi concebido usando o Vemto (Brazilian Laravel low code plataform) para gerar os cruds simples. Que também poderia ser feito com InfyOm ou Blueprint.
Porém, nem tudo são flores. As estórias de usuário precisaram ser desenvolvidas, tanto no backend ou frontend.

Caros devs, desenvolvi ele em 1 dia. Gostaria muito de implementar mais features para ficar melhor, mas como trabalho, fico sem tempo. Façam forks e me mandem suas branches para eu fazer pull requests se quiserem participar...

Boas práticas aplicadas:
- SOLID
- PSR

Poderia ser aplicado:
- Strategy (caso queiram usar outros tipos de datatable no fronend)
- Decorator (para gerar descontos, como cupons, vales, etc)

Nota: Design Patterns devem ser cautelosamente usados, em extrema necessidade! Verificar uma região do código que realmente necessita é fundamental para otimizar melhor o nosso desenvolvimento. 
We will refact after, i promise... (rrsrsrs)

# Instalação

# Com docker
  * Instale o Docker
  * Execute o Docker
  * Execute no terminal: composer install
  * Execute no terminal: npm install
  * Descompacte o laradock.rar (ficará assim: "/var/www/laradock/".env)
  * Acesse a pasta "/var/www/laradock/"
  * Para subir o container com apache:
      * docker-compose up -d apache2 mysql phpmyadmin
  * Para subir o container com nginx: 
      * docker-compose up -d nginx mysql phpmyadmin  
  * Caso execute com apache, renomeie o htaccess para .htaccess 
  * Crie o banco de dados 'my_app' pelo phpMyAdmin (http://127.0.0.1:8083/) (user:'root', password:'root')
  * Volte para a raiz do projeto "/var/www/"
  * Abra o arquivo .env em "/var/www/" e deixe o campo DB_HOST assim DB_HOST=127.0.0.1
  * Execute o comando php artisan migrate:fresh --seed 
    * Caso o php instalado no seu computador seja menor que o 7.4: 
      * Na pasta "/var/www/laradock/" execute no terminal: docker exec -it laradock_workspace_1 bash
      * Estando dentro do terminal do container, execute o comando no terminal: php artisan migrate:fresh --seed
  * Abra o arquivo .env em "/var/www/" e deixe o campo DB_HOST assim: DB_HOST=mysql
  * Faça login: http://127.0.0.1:8087/
    * E-mail: admin@admin.com
    * Senha: admin

# Com XAMPP
  
  * Instale o XAMPP com php 7.4 (PHP + MySQL + PHPMyAdmin)
  * Copie o projeto na pasta "htdocs/", ficando assim:
    * htdocs/ 
        app/
        bootstrap/ (etc)
  * Renomeie o htaccess para .htaccess, ou execute no terminal:
      cp htaccess .htaccess
  * Acesse localhost/phpmyadmin
  * Crie o banco de dados my_app
  * Na pasta "htdocs/" execute no terminal: php artisan migrate:fresh --seed
  * Faça login
    * E-mail: admin@admin.com
    * Senha: admin

# Grato!




