FROM php:8.1-apache

RUN docker-php-ext-install \
    # extension for mysql pdo
    pdo_mysql \
    # for laravel work
    && a2enmod \
    rewrite