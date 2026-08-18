# Laravel 11 + Filament 5 — PHP-FPM (dipakai bareng service `nginx`)
FROM php:8.3-fpm-alpine

# Samakan UID/GID www-data dengan user host supaya storage/ & bootstrap/cache
# tetap writable saat folder backend di-bind mount.
ARG UID=1000
ARG GID=1000

RUN apk add --no-cache shadow git unzip icu-dev linux-headers \
    && ( getent group ${GID} >/dev/null || groupmod -g ${GID} www-data ) \
    && ( usermod -u ${UID} -g ${GID} www-data || true )

# Ekstensi yang dibutuhkan Laravel + Filament.
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    bcmath \
    intl \
    gd \
    exif \
    zip \
    pcntl \
    opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# php-fpm secara default membuang environment dari container; matikan supaya
# override DB_HOST/APP_URL dari docker-compose kebaca oleh env() Laravel.
RUN echo "clear_env = no" >> /usr/local/etc/php-fpm.d/zz-docker.conf

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY backend/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENV COMPOSER_HOME=/tmp/composer \
    COMPOSER_ALLOW_SUPERUSER=0

WORKDIR /var/www/html
USER www-data

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]
