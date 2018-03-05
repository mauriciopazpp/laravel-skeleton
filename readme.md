# Skeleton laravel

## Tecnologias utilizadas

* Laravel 5.4
* MySQL database
* Laravel Passport

## Libs
* [laravel/passport](https://github.com/laravel/passport) - Laravel Passport API
* [lavary/laravel-menu](https://github.com/lavary/laravel-menu) - Menu builder
* [lukzgois/request](https://packagist.org/packages/lukzgois/request) - request validation personalized
* [artesaos/defender](https://github.com/artesaos/defender) - ACL defender
* [AdminLTE](https://adminlte.io/) - Interface
* [orchestra/imagine](https://github.com/orchestral/imagine) - Tratamento de imagens

## Requisitos
* PHP >= 5.6.*
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

## Apache

Laravel includes a public/.htaccess file that is used to provide URLs without the index.php front controller in the path. Before serving Laravel with Apache, be sure to enable the mod_rewrite module so the .htaccess file will be honored by the server.

If the .htaccess file that ships with Laravel does not work with your Apache installation, try this alternative:
```javascript
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```
## Nginx
If you are using Nginx, the following directive in your site configuration will direct all requests to the index.php front controller:


```javascript
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```
## Instalação
```javascript
composer install -vvv --profile --no-scripts
```
```javascript
php -r "copy('.env.example', '.env');" && php artisan key:generate && php artisan clear-compiled && php artisan optimize && php artisan route:clear
```
Se necessário:
```javascript
sudo chown -R youruser:yourgroup ./
```
```javascript
 sudo chown -R www-data:www-data ./storage/ && sudo chmod 777 -R ./storage && sudo chmod 777 -R ./bootstrap/cache && sudo chmod -R guo+w ./storage/
```
e entre com as configurações no arquivo .env

Crie o banco de dados
```sql
mysql -u youruser -p yourpass
```
```sql
create database laravel_database;
```
Insira as informações do banco no arquivo .env
```javascript
DB_HOST=localhost
DB_DATABASE=laravel_database
DB_USERNAME=yourusername
DB_PASSWORD=yourpass
```
Para criar banco com o migration:
```javascript
php artisan migrate:refresh --seed
```

### Configurando a API
This command will create the encryption keys needed to generate secure access tokens
```javascript
 php artisan passport:install
```
To publish the Passport Vue components to create a tokens
```javascript
php artisan vendor:publish --tag=passport-components
```
Se necessário:
When deploying Passport to your production servers for the first time, you will likely need to run the  passport:keys command. This command generates the encryption keys Passport needs in order to generate access token. The generated keys are not typically kept in source control:

```javascript
php artisan passport:keys
```
To create a client 
```javascript
php artisan passport:client
```
Before your application can issue tokens via the password grant, you will need to create a password grant client
```javascript
php artisan passport:client --password
```
## Acesso
```javascript
 Login: email@gmail.com
 pass: password
```
## Dicas
Para ver as rotas
```javascript
 php artisan route:list
```
