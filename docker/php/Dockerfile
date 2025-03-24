FROM php:8.1-fpm

# Establecer el directorio de trabajo
WORKDIR /var/www

# Actualizar repositorios e instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && apt-get install -y libssl-dev \
    && pecl install redis \
    && docker-php-ext-enable redis  # Instalar y habilitar la extensión Redis

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer permisos y propietario adecuado para el directorio de logs de Laravel
RUN mkdir -p /var/www/storage && \
    chown -R www-data:www-data /var/www/storage && \
    chmod -R 775 /var/www/storage

# Establecer el comando predeterminado para el contenedor
CMD ["php-fpm"]
