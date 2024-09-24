BACKEND_DOCKER_COMPOSE = backend/docker-compose.yml
FRONTEND_DOCKER_COMPOSE = frontend/docker-compose.yml

DOCKER_COMPOSE = docker-compose -f

.PHONY: build backend-setup frontend-setup up down restart

# Собрать все образы без кэша (по желанию: используйте --no-cache)
build: backend-setup frontend-setup

# Настроить и собрать бэкенд без кэша
backend-setup:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) build --no-cache

# Настроить и собрать фронтенд без кэша
frontend-setup:
	$(DOCKER_COMPOSE) $(FRONTEND_DOCKER_COMPOSE) build --no-cache

# Запустить все контейнеры
up:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) up -d
	$(DOCKER_COMPOSE) $(FRONTEND_DOCKER_COMPOSE) up -d

# Остановить и удалить все контейнеры
down:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) $(FRONTEND_DOCKER_COMPOSE) down

# Перезапустить все контейнеры
restart: down up

# Просмотр логов
logs:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) logs -f
	$(DOCKER_COMPOSE) $(FRONTEND_DOCKER_COMPOSE) logs -f

# Выполнить миграции Laravel
migrate:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan migrate

# Выполнить миграции и сбросить базу данных
migrate-fresh:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan migrate:fresh

# Выполнить миграции в тестовой среде
migrate-testing:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan migrate --env=testing

# Выполнить миграции и сразу запустить сидеры
migrate-fresh-seed:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan migrate:fresh --seed

# Запустить сидеры базы данных
seed:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan db:seed

# Выполнить тесты
test:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan test

# Выполнить тесты с фильтром
test-filtered:
	$(DOCKER_COMPOSE) $(BACKEND_DOCKER_COMPOSE) exec backend-app php artisan test --filter $(filter)
