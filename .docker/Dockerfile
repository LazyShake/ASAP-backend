FROM php:8.1-fpm
# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    htop \
    wget \
    lynx \
    curl \
    mc \
    vim \
    libmcrypt-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libmagickwand-dev \
    libxml2-dev \
    unzip \
    libzip-dev \
    locales \
    tzdata \
    nano \
    libpq-dev \
    zip

RUN docker-php-ext-install pgsql \
        && docker-php-ext-install pdo_pgsql

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd \
        && docker-php-ext-configure gd  --with-freetype --with-jpeg \
        &&  docker-php-ext-enable gd

RUN pecl install imagick \
        && docker-php-ext-enable imagick


COPY ./ /var/www
# Set working directory
WORKDIR /var/www

# xdebug
COPY .ops/conf/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# add test debian repository
RUN cp .env.example .env
RUN composer install

RUN php artisan key:generate

# cleanup
RUN apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && rm -fr /tmp/* \
    && rm -fr /var/tmp/*

#
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
