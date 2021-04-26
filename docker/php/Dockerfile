FROM php:8.0.3-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000

WORKDIR /app
ADD . /app

RUN chown -R www-data:www-data /app

ENV PHP_AUTOCONF=/usr/bin/autoconf

RUN apk update && apk upgrade
RUN apk add --no-cache \
        php8-pear \
        autoconf \
        automake \
        libtool \
        build-base \
        libsodium \
        libsodium-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev

RUN docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-enable gd \
        && apk del --no-cache \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        && rm -rf /tmp/*

RUN pecl install opcache \
        libsodium-stable \
        apcu
        # apc

RUN docker-php-ext-install \
        mysqli \
        pdo pdo_mysql

RUN docker-php-ext-enable gd.so opcache.so sodium.so
RUN docker-php-ext-enable gd mysqli pdo pdo_mysql
RUN docker-php-ext-enable --ini-name 0-apc.ini apcu apc

RUN pecl install ext-fiber
RUN docker-php-ext-enable ext-fiber
