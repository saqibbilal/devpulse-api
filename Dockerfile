# Stage 1: PHP Dependencies
FROM php:8.4-fpm-alpine AS vendor
WORKDIR /var/www/html

# Install Postgres dev dependencies for the driver in stage 1
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql

COPY composer.json composer.lock ./
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Stage 2: Final Production Image
FROM php:8.4-fpm-alpine
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache nginx supervisor libpq libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apk del libpq-dev

# --- ADD THIS LINE BELOW ---
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx and Supervisor configs
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Optimized autoloader (This will work now!)
RUN composer dump-autoload --optimize

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
