FROM php:7.2-apache

COPY . /var/www/html

RUN docker-php-ext-install calendar && a2enmod rewrite && mv /var/www/html/php.ini /usr/local/etc/php/conf.d/php.ini
