# Stage 1: PHP Dependencies
FROM php:8.4-fpm-alpine AS vendor
WORKDIR /var/www/html

RUN apk add --no-cache \
    libpq-dev \
    icu-dev \
    libzip-dev

# IMPORTANT: install PHP extensions needed for Composer validation
RUN docker-php-ext-install \
    pdo_pgsql \
    exif \
    intl \
    zip

COPY composer.json composer.lock ./
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install \
    --no-dev \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --ignore-platform-req=ext-intl \
    --ignore-platform-req=ext-zip

# Stage 2: Final Production Image
FROM php:8.4-fpm-alpine
WORKDIR /var/www/html

# 1. Install Runtime Libraries
# 2. Compile Extensions in a single layer to keep image size < 200MB
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpq \
    icu-libs \
    libzip \
    && apk add --no-cache --virtual .build-deps \
    libpq-dev \
    icu-dev \
    libzip-dev \
    zlib-dev \
    && docker-php-ext-install pdo_pgsql exif intl zip \
    && apk del .build-deps

# Copy application code
# IMPORTANT: Ensure 'vendor' is in your .dockerignore file
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx and Supervisor configs
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
