# Используем официальный образ PHP
FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/backend

# Копируем файлы
COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Копируем .env.example в .env, если .env не существует
RUN cp .env.example .env || true

# Генерируем ключ приложения
RUN php artisan key:generate

# Открываем порт 9000
EXPOSE 9000

# Запускаем PHP-FPM
CMD ["php-fpm"]
