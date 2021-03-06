FROM php:7.4-apache

RUN apt-get update \
    && apt-get upgrade -y

# xdebug
RUN pecl install xdebug

# phpredis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear

RUN apt-get install -y \
        # utils
        nano \
        unzip \
        #gd
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        #zip
        libzip-dev \
        # gmp
        libgmp-dev \
        # regex
        libonig-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mbstring zip mysqli pdo_mysql gmp \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable redis \
    && docker-php-source delete

# Create working directory
RUN mkdir -p /var/www/

ENV APACHE_DOCUMENT_ROOT /var/www/public

# Install composer from image. You may change it to the latest
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Some aliasses.
RUN echo 'alias pa="php artisan"' >> ~/.bashrc
RUN echo 'alias phpunit="./vendor/bin/phpunit"' >> ~/.bashrc
RUN echo 'alias refresh="pa migrate:fresh"' >> ~/.bashrc

# make laravel feel comfortable with mod-rewrite
RUN a2enmod rewrite && service apache2 restart
EXPOSE 80
