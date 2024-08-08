FROM php:7.4-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY www/ /var/www/html/

RUN mkdir -p /var/www/html/public/Images \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
