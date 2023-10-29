FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    vim \
    curl \
    wget

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

ENTRYPOINT [ "docker-php-entrypoint" ]

CMD [ "apache2-foreground" ]

RUN curl --version
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
RUN composer dumpautoload