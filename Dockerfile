# Add PHP-Apache base image
FROM php:8.0-apache
# Install pdo is you need to use PHP PDO
RUN docker-php-ext-install pdo pdo_mysql