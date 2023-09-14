FROM php:8.1-apache
RUN apt-get update && apt-get install -y git
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite
COPY api /var/www/html/
EXPOSE 80