# Laravel Vue Starter

## Описание
Это проект, состоящий из двух частей: бэкенда на Laravel 10 и фронтенда на Vue.js 3. Он использует PostgreSQL 15 в качестве базы данных и Docker для контейнеризации.

## Структура проекта

```plaintext
laravel-vue-starter/
│
├── backend/                      # Директория для Laravel
│   ├── app/                      # Основная логика приложения
│   ├── bootstrap/                # Файлы для инициализации приложения
│   ├── config/                   # Конфигурационные файлы
│   ├── database/                 # Миграции и сидеры базы данных
│   ├── public/                   # Публичные файлы (например, index.php)
│   ├── resources/                # Шаблоны, локализации
│   ├── routes/                   # Файлы маршрутов
│   ├── storage/                  # Логи, файлы кэша, загруженные файлы
│   ├── tests/                    # Тесты
│   ├── docker/                   # Директория для Docker файлов
│   │   ├── nginx/                # Директория для Nginx конфигурации
│   │   │   └── default.conf      # Конфигурационный файл Nginx для Laravel
│   │   └── Dockerfile            # Dockerfile для бэкенда
│   └── docker-compose.yml        # docker-compose для бэкенда
│
├── frontend/                     # Директория для Vue
│   ├── public/                   # Публичные файлы (например, index.html)
│   ├── src/                      # Исходный код приложения
│   │   ├── assets/               # Статические ресурсы (изображения, стили)
│   │   ├── components/           # Vue-компоненты
│   │   ├── views/                # Вьюхи (страницы)
│   │   ├── router/               # Настройки маршрутизации
│   │   └── store/                # Vuex (глобальное состояние)
│   ├── tests/                    # Тесты для Vue
│   ├── docker/                   # Директория для Docker файлов
│   │   ├── nginx/                # Директория для Nginx конфигурации
│   │   │   └── default.conf      # Конфигурационный файл Nginx для Vue
│   │   └── Dockerfile            # Dockerfile для фронтенда
│   └── docker-compose.yml        # docker-compose для фронтенда
│
├── Makefile                      # Скрипты для сборки и управления проектом
└── README.md                     # Документация проекта
```

## Установка

Следуйте этим шагам, чтобы установить проект:

1. **Клонируйте репозиторий**:
   ```bash
   git clone https://github.com/itech-programmer/laravel-vue-starter.git
   cd laravel-vue-starter

2. **Соберите и запустите проект**:
    ```bash
    make up
    ```

## Использование
После запуска проекта, вы сможете получить доступ к следующим компонентам:

- **Приложение Vue**: [http://localhost:3000](http://localhost:3000)
- **API Laravel**: [http://localhost:8000](http://localhost:8000)

### Скриншоты

<div style="display: flex; align-items: center;">
    <img src="https://vuejs.org/images/logo.png" alt="Vue Logo" width="50" height="50" style="margin-right: 10px;" />
    <img src="https://laravel.com/img/logotype.min.svg" alt="Laravel Logo" width="100" height="100" />
</div>

### Примечания

Убедитесь, что все сервисы запущены, прежде чем пытаться получить доступ к этим адресам.

## Команды
make up: Запускает все сервисы в фоновом режиме.
make down: Останавливает все сервисы.

## Команды Makefile

Ниже приведены команды, которые можно использовать для управления проектом. Каждая команда имеет краткое описание и примеры использования.

- **`make build`**: Собирает все Docker образы без использования кэша.
- 
```bash
make build
```

- **`make backend-setup`**: Настраивает и собирает Docker образ для бэкенда (Laravel) без использования кэша.
-
```bash
make backend-setup
```

- **`make frontend-setup`**: Настраивает и собирает Docker образ для фронтенда (Vue) без использования кэша.
-
```bash
make frontend-setup
```

- **`make up`**: Запускает все контейнеры (бэкенд и фронтенд) в фоновом режиме.
-
```bash
make up
```

После выполнения этой команды, доступ к приложениям будет по адресам:

- **Vue:** [Vue](http://localhost:3000)
- **API Laravel:** [API Laravel](http://localhost:8000)


- **`make down`**: Останавливает и удаляет все контейнеры.

```bash
make down
```

- **`make restart`**: Перезапускает все контейнеры. Сначала останавливает, затем запускает снова.

```bash
make restart
```

- **`make logs`**: Просматривает логи всех контейнеров в реальном времени.

```bash
make logs
```

- **`make migrate`**: Выполняет миграции базы данных для Laravel.

```bash
make migrate
```

- **`make migrate-fresh`**: Сбрасывает и выполняет все миграции базы данных.

```bash
make migrate-fresh
```

- **`make migrate-testing`**: Выполняет миграции в тестовой среде.

```bash
make migrate-testing
```

- **`make migrate-fresh-seed`**: Сбрасывает базу данных и сразу выполняет сидеры.

```bash
make migrate-fresh-seed
```

- **`make seed`**: Запускает сидеры базы данных.

```bash
make seed
```

- **`make test`**: Выполняет тесты Laravel.

```bash
make test
```

- **`make test-filtered`**: Выполняет тесты Laravel с фильтром. Позволяет запускать только определенные тесты.

```bash
make test-filtered filter=YourTestName
```

## Технологии
- **`Laravel`**: PHP фреймворк для бэкенда
- **`Vue.js`**: JavaScript фреймворк для фронтенда
- **`PostgreSQL`**: Система управления базами данных
- **`Docker`**: Платформа для контейнеризации
- **`Yarn`**: Менеджер пакетов для JavaScript