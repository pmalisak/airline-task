FROM php:8.3.4-fpm-alpine3.19
WORKDIR "/app"

# Update
RUN apk update
RUN apk add libzip-dev zip

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_mysql mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN apk --update --no-cache add autoconf g++ make linux-headers && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug \

#RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug

# Cleanup
#RUN apt-get clean
#RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
