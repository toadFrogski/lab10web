FROM php:8.3-fpm-alpine

WORKDIR /var/www/webapp

COPY . .

RUN docker-php-ext-install \
    mysqli \
    && docker-php-ext-enable \
    mysqli
