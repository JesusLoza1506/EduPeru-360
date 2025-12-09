FROM php:8.2-fpm

# Instala dependencias necesarias para GD y otras extensiones comunes
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip unzip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia el código de la app
WORKDIR /var/www/html
COPY . .

# Da permisos a storage y bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expone el puerto 9000 (por defecto en php-fpm)
EXPOSE 9000

CMD ["php-fpm"]
