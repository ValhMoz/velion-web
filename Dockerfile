FROM php:apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli
