FROM php:8.0.3-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000

WORKDIR /app
ADD . /app

RUN chown -R www-data:www-data /app

ENV PHP_AUTOCONF=/usr/bin/autoconf
ENV PKG_CONFIG_PATH=/usr/lib/pkgconfig

RUN apk update && apk upgrade
RUN apk add --no-cache pkgconfig
RUN pkg-config --variable pc_path pkg-config

RUN apk add --no-cache \
        php8-pear \
        autoconf \
        automake \
        libtool \
        build-base \
        libsodium \
        libsodium-dev

RUN pecl install \
        gd \
        opcache \
        libsodium-stable \
        apcu \
        apc

RUN docker-php-ext-enable \
        gd \
        mysqli pdo pdo_mysql \
        opcache \
        sodium \
         --ini-name 0-apc.ini apcu apc

RUN pecl install ext-fiber
RUN docker-php-ext-enable ext-fiber
