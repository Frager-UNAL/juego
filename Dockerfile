# Use this docker container to build from
FROM php:7.2-apache

# install all the system dependencies and enable PHP modules
RUN apt-get update\
     && apt-get install -y libicu-dev  libpq-dev  libpng-dev   libmcrypt-dev  default-mysql-client git zip unzip 
RUN command rm -r /var/lib/apt/lists/* 
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd 
RUN apt-get update && apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt
RUN docker-php-ext-install intl mbstring  pcntl pdo_mysql pdo_pgsql pgsql zip gd opcache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get update \
    && apt-get install -y  openssl libssl-dev libcurl4-openssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb



# set our application folder as an environment variable


# change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# apache configs + document root
COPY /config/ /var/www/html/public/

COPY /src/  /var/www/html

EXPOSE 80