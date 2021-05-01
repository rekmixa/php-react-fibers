FROM php:8.0.5-fpm-alpine

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG USER_ID=1000

ADD . /app

RUN chown -R www-data:www-data /app

ENV PHP_AUTOCONF=/usr/bin/autoconf

RUN apk update && apk upgrade
RUN apk add --no-cache \
        git \
        php8-pear \
        php8-gd \
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
        --with-freetype=/usr/local/lib/php/extensions \
        --with-jpeg=/usr/local/lib/php/extensions \
        && docker-php-ext-install -j$(nproc) gd \
        && apk del --no-cache \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        && rm -rf /tmp/*

RUN pecl install opcache \
        libsodium-stable \
        apcu

RUN docker-php-ext-install \
        mysqli \
        pdo pdo_mysql

RUN docker-php-ext-enable gd.so opcache.so sodium.so
RUN docker-php-ext-enable mysqli pdo pdo_mysql
RUN docker-php-ext-enable --ini-name 0-apc.ini apcu

# RUN pecl install ext-fiber
# RUN docker-php-ext-enable ext-fiber

WORKDIR /usr/local/lib

RUN git clone https://github.com/amphp/ext-fiber \
        && cd ext-fiber \
        && phpize \
        && ./configure \
        && make \
        && make install \
        && cd ../ && rm -rf ext-fiber

RUN docker-php-ext-enable fiber.so

WORKDIR /app
