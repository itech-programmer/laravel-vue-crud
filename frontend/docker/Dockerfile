# Используем официальный образ Node.js
FROM node:18 AS builder

# Устанавливаем рабочую директорию
WORKDIR /var/www/frontend

# Копируем package.json и yarn.lock
COPY package.json yarn.lock ./

# Устанавливаем зависимости
RUN yarn install

# Копируем файлы проекта
COPY . .

# Собираем приложение
RUN yarn build

# Этап 2: Запуск Nginx
FROM nginx:alpine

# Копируем собранное приложение
COPY --from=builder /var/www/frontend/dist /usr/share/nginx/html

# Открываем порт 80
EXPOSE 80

# Запускаем Nginx
CMD ["nginx", "-g", "daemon off;"]
