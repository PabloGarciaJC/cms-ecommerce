## ---------------------------------------------------------
## Comando base para docker-compose
## ---------------------------------------------------------

DOCKER_COMPOSE = docker compose -f ./.docker/docker-compose.yml

## ---------------------------------------------------------
## Inicialización de la Aplicación
## ---------------------------------------------------------

.PHONY: init-app
init-app: | copy-env set-permissions create-symlink up print-urls

.PHONY: copy-env
copy-env:
	@ [ ! -f .env ] && cp .env.example .env || true

.PHONY: set-permissions
set-permissions:
	@chmod -R 777 ./config/.log
	@chmod g+s ./config/.log

.PHONY: create-symlink
create-symlink:
	@ [ -L .docker/.env ] || ln -s ../.env .docker/.env

.PHONY: print-urls
print-urls:
	@echo "## Acceso a la Aplicación:   http://localhost:8081/"
	@echo "## Acceso a PhpMyAdmin:      http://localhost:8082/"

## ---------------------------------------------------------
## Gestión de Contenedores
## ---------------------------------------------------------

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart:
	$(DOCKER_COMPOSE) restart

.PHONY: ps
ps:
	$(DOCKER_COMPOSE) ps

.PHONY: logs
logs:
	$(DOCKER_COMPOSE) logs

.PHONY: build
build:
	$(DOCKER_COMPOSE) build

.PHONY: stop
stop:
	$(DOCKER_COMPOSE) stop

.PHONY: init-test
init-test:
	mkdir -p tests/Controllers tests/Models tests/Views tests/Helpers
	$(DOCKER_COMPOSE) exec php_apache_ecommerce mv /usr/local/bin/phpunit /var/www/html/tests/phpunit.phar
	$(DOCKER_COMPOSE) exec php_apache_ecommerce ls -l /var/www/html/tests/phpunit.phar
	touch tests/Controllers/ExampleControllerTest.php
	touch tests/Models/ExampleUserModelTest.php
	touch tests/Views/ExampleHomeViewTest.php
	touch tests/Helpers/ExampleStringHelperTest.php

.PHONY: clean-all
clean-all:
	sudo docker rmi -f $$(sudo docker images -q) || true
	sudo docker volume rm $$(sudo docker volume ls -q) || true
	sudo docker network prune -f || true

.PHONY: clean-specific
clean-specific:
	sudo docker rmi mysql:latest || true
	sudo docker volume rm docker_persistent-ecommerce || true
	sudo docker network rm network_ecommerce || true

.PHONY: shell
shell:
	$(DOCKER_COMPOSE) exec --user pablogarciajc php_apache_ecommerce  /bin/sh -c "cd /var/www/html/; exec bash -l"