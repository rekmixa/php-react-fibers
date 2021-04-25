FROM php:8.0.3-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000

WORKDIR /app
ADD . /app

RUN chown -R www-data:www-data /app

RUN export PHP_AUTOCONF=/usr/bin/autoconf

RUN apk update && apk upgrade
RUN apk add --no-cache \
        php8-pear \
        autoconf \
        automake \
        libtool \
        build-base \
        libsodium \
        libsodium-dev

RUN pecl install \
        opcache \
        libsodium-stable

RUN docker-php-ext-enable \
        opcache \
        sodium
