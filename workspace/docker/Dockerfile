FROM php:8.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        zip \
    && docker-php-ext-install pdo_mysql mysqli \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www/html

EXPOSE 80