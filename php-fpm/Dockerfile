FROM php:8.2.4-fpm

RUN apt-get update -yqq && apt-get install -y git
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql


RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer