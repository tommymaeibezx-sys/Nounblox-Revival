FROM php:8.2-apache

# Activar mod_rewrite
RUN a2enmod rewrite

# Copiar archivos al servidor
COPY . /var/www/html/

# Permitir .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

EXPOSE 80
