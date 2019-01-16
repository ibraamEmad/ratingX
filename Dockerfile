FROM php:7.1.16-apache


RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

# RUN cd ../../ 
ADD . /var/www
ADD ./public /var/www/html

RUN chown -R www-data:www-data /var/www

EXPOSE 8080