FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000