FROM php:7.4-apache

# Instalar el controlador pgsql
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql
