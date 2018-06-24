install:
	composer install
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate
	php bin/console doctrine:fixtures:load

deploy:
	composer install
	php bin/console server:start

integration:
	./vendor/bin/behat --suite=graphql tests/features
