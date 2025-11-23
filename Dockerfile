FROM php:8.2-apache

WORKDIR /var/www/html

# Copiar el código del frontend
COPY . /var/www/html

# Opcional: si usas URL del backend como variable de entorno, luego la puedes pasar por docker-compose
EXPOSE 80