FROM composer:2.2.25 AS build

COPY . /app
WORKDIR /app
RUN composer install

FROM php:8.2-fpm

COPY --from=build /app/vendor /var/www/html/vendor
COPY --from=build /app/src /var/www/html/src
COPY --from=build /app/public/ /var/www/html
