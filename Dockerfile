FROM php:8.2-apache

# Habilitar mod_rewrite y permitir .htaccess en /var/www/html
RUN a2enmod rewrite \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copiar tu proyecto
COPY . /var/www/html

EXPOSE 80
