# urlCheckerApp
A test task on distributed workers

## Versions:
**Symfony 4.4**

**PHP 7.4.6**

**MySQL 5.7**

## Install and run:
1. ```git clone git@github.com:DmitryIvanov10/urlCheckerApp.git```
2. ```cd urlCheckerApp```
3. ```docker-compose up --build -d```
3. Install composer, migrate DB, load fixtures ```docker exec -d php make fresh```
4. Add ```127.0.0.1 app.local``` to `/etc/hosts`
5. Check if everything works and get `phpinfo()` at `app.local:81/php_info`

## Create new line for the URL to check
1. Get inside the container: ```docker exec -it php sh```
2. Run command ```php bin/console app:url-check:create some.url``` (change the URL argument)

## Adding messages to check URLs to the queue and handling them asynchronously
1. Get into the PHP container ```docker exec -it php sh```
2. Create and dispatch messages ```bin/console app:url-check:run```
3. Consume messages and actually handle them ```php bin/console messenger:consume async```

## Important
Composer can be updated inside the **php** container
All migrations should be run inside the **php** container
