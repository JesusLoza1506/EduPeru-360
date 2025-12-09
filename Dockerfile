FROM php:8.2-fpm

# Instala dependencias necesarias para GD y otras extensiones comunes
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libxpm-dev zip unzip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install gd pdo pdo_mysql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia el código de la app
WORKDIR /var/www/html
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Da permisos a storage y bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expone el puerto 8080 (o el que Railway defina)
EXPOSE 8080

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
