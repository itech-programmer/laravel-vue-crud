<h1 style="display: inline; vertical-align: middle;">Laravel-Vue CRUD Application</h1>
<img src="https://vuejs.org/images/logo.png" alt="Vue Logo" width="50" height="50" style="display: inline; vertical-align: middle;" />

## Описание

Это приложение для управления продуктами, созданное с использованием **Laravel** для бэкенда и **Vue.js** для фронтенда. Приложение реализует полное CRUD (Create, Read, Update, Delete) функционал для управления товарами.

## Стек технологий

- **Backend:** Laravel 10, PostgreSQL
- **Frontend:** Vue 3, Vite, Bootstrap
- **Docker:** Для контейнеризации приложения
- **Тестирование:** PHPUnit для бэкенда и Jest для фронтенда

## Установка

### Требования

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Клонирование репозитория

```bash
git clone https://github.com/ваш_пользователь/laravel-vue-crud.git
cd laravel-vue-crud
```

## Запуск приложения

### 1. Соберите и запустите контейнеры:

```bash
docker-compose up --build
```

### 2. Запустите миграции:

```bash
docker-compose exec backend-app php artisan migrate
```

### 3. Откройте приложение в браузере:

- **Laravel Admin Interface:** [http://localhost:8000](http://localhost:8000)
- **Vue User Interface:** [http://localhost:3000](http://localhost:3000)

## Структура проекта

```plaintext
laravel-vue-crud/
├── frontend/                     # Директория для Vue
│   ├── src/                      # Исходный код приложения
│   ├── tests/                    # Тесты для Vue
│   └── docker/                   # Директория для Docker файлов
```
## Функциональность

- 🆕 **Добавление продуктов**: Пользователи могут добавлять новые продукты.
- ✏️ **Редактирование продуктов**: Пользователи могут редактировать существующие продукты.
- 🗑️ **Удаление продуктов**: Пользователи могут удалять продукты.
- 📋 **Просмотр списка продуктов**: Пользователи могут просматривать все продукты в виде списка.



