FROM php:apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Asegurarse de que el directorio de documentos existe y tiene los permisos correctos
RUN mkdir -p /var/www/html/doc && \
    chown -R www-data:www-data /var/www/html/doc && \
    chmod -R 755 /var/www/html/doc
