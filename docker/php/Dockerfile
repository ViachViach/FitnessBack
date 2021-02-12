FROM php:8-fpm-alpine

RUN set -xe && apk update && apk add --no-cache \
    libzip \
    bash \
    curl \
    libmcrypt \
    libmcrypt-dev \
    libxml2-dev \
    postgresql-dev \
    pcre-dev \
    git \
    autoconf \
    g++ \
    make \
    icu-dev \
    composer $PHPIZE_DEPS icu-dev icu-libs git \
    libzip-dev libmcrypt-dev libsodium libsodium-dev oniguruma oniguruma-dev \
    protoc linux-headers postgresql-dev openssh-client zlib-dev \
    && docker-php-source extract \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && docker-php-ext-install pdo_pgsql pcntl sockets soap intl


COPY symfony.ini /usr/local/etc/php/conf.d/symfony.ini
COPY xdebug.ini  /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www
