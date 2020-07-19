fresh: init load-fixtures
init:
	composer install
	yes | php bin/console doctrine:migrations:migrate
load-fixtures:
	yes "yes" | php bin/console doctrine:fixtures:load
