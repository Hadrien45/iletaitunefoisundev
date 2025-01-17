.PHONY: build tests

PHP_XDEBUG = php
PHP = XDEBUG_MODE=off php

generate-keypair:
	@echo "\nGenerate keypair...\e[0m"
	@$(PHP) bin/console lexik:jwt:generate-keypair --overwrite -n --env=$(env)

install: composer-install install-app

composer-install:
	@echo "\nInstall dependencies...\e[0m"
	composer install

composer-update:
	@echo "\Update dependencies...\e[0m"
	composer update

install-app:
	@echo "\Install application...\e[0m"
	$(PHP) bin/console app:install

analyse: composer-valid container-linter mapping-valid phpcpd churn-php phpstan

phpstan:
	@echo "\nRunning phpstan...\e[0m"
	$(PHP) vendor/bin/phpstan analyse --configuration=phpstan.neon

php-cs-fixer:
	@echo "\nRunning php-cs-fixer...\e[0m"
	@$(PHP) vendor/bin/php-cs-fixer fix

phpcpd:
	@echo "\nRunning phpcpd...\e[0m"
	@$(PHP) vendor/bin/phpcpd src --exclude src/Admin/Controller

churn-php:
	@echo "\nRunning churn-php...\e[0m"
	@$(PHP) vendor/bin/churn run --configuration=churn.yml

container-linter:
	@echo "\nRunning container linter...\e[0m"
	@$(PHP) bin/console lint:container

composer-valid:
	@echo "\nRunning container valid...\e[0m"
	composer valid

mapping-valid:
	@echo "\nRunning mapping valid...\e[0m"
	@$(PHP) bin/console doctrine:schema:valid --skip-sync

tests:
	@echo "\nRunning tests...\e[0m"
	@$(PHP) bin/phpunit

tests-coverage:
	@echo "\nRunning tests coverage...\e[0m"
	$(PHP_XDEBUG) bin/phpunit

unit-tests:
	@echo "\nRunning unit tests...\e[0m"
	@$(PHP) bin/phpunit --testsuite=unit

component-tests:
	@echo "\nRunning component tests...\e[0m"
	@$(PHP) bin/phpunit --testsuite=component

integration-tests:
	@echo "\nRunning integration tests...\e[0m"
	@$(PHP) bin/phpunit --testsuite=integration

functional-tests:
	@echo "\nRunning functional tests...\e[0m"
	@$(PHP) bin/phpunit --testsuite=functional

end-to-end-tests:
	@echo "\nRunning end to end tests...\e[0m"
	@$(PHP) bin/phpunit --testsuite=end-to-end

database:
	echo "\nSetup database...\e[0m"
	$(PHP) bin/console doctrine:database:drop --if-exists --force --env=$(env)
	$(PHP) bin/console doctrine:database:create --env=$(env)
	$(PHP) bin/console doctrine:schema:update --force --env=$(env)

fixtures:
	@echo "\nLoad fixtures...\e[0m"
	$(PHP) bin/console doctrine:fixtures:load -n --env=$(env)

fix: php-cs-fixer

prepare: database fixtures

server-start:
	@echo "\nStart server...\e[0m"
	symfony server:start -d

server-stop:
	@echo "\nStart server...\e[0m"
	symfony server:stop
