# nginx-php-symfony-mysql-dockerized-boilerplate
Boilerplate for Symfony projects in docker

## Versions:
**Symfony 4.4**

**PHP 7.4.6**

**MySQL 5.7**

## Install and run:
1. ```git clone git@github.com:DmitryIvanov10/nginx-php-symfony-mysql-dockerized-boilerplate.git```
2. ```cd nginx-php-symfony-mysql-dockerized-boilerplate```
3. ```docker-compose up --build -d```
3. ```docker exec -it php sh```
4. Inside php container: ```composer update``` and ```composer install```
5. Add ```127.0.0.1 app.local``` to `/etc/hosts`
6. Check if everything works and get `phpinfo()` at `app.local:81/php_info`

## Important
This build doesn't contain doctrine 
Composer can be updated inside the **php** container
All migrations should be run inside the **php** container
