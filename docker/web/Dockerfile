FROM php:7.4.7-apache

# Create directory www when website code will hosted
RUN mkdir /var/www/html/www

RUN a2enmod rewrite \
	proxy \
	proxy_http \
	&& service apache2 restart

RUN apt-get update && apt-get install -y \
        freetds-bin \
        freetds-dev \
        freetds-common \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        jpegoptim \
        optipng \
        pngquant \
        gifsicle \
        libxml2-dev \
        libzip-dev \
        git \
        curl \
        zlib1g-dev \
        libicu-dev \
        libwebp-dev \
        libonig-dev \
    && pecl install mcrypt-1.0.3 \
    && apt-get -y autoclean \
    && docker-php-ext-install -j$(nproc) \
        iconv \
        exif \
        bcmath \
        mysqli \
        calendar \
        ctype \
        soap \
        zip \
        pdo \
        pdo_mysql \
        mbstring \
        intl \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        --with-webp=/usr/include/ \
    && docker-php-ext-configure pdo_dblib --with-libdir=lib/x86_64-linux-gnu \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo_dblib \
    && docker-php-ext-enable \
        opcache \
        intl \
        pdo_dblib \
        mcrypt

RUN docker-php-ext-install -j$(nproc) \
	sysvmsg \
	sysvsem \
	sysvshm

# install composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --2

# NODE,NPM [
# replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# update the repository sources list
# and install dependencies
#RUN apt-get update \
#    && apt-get install -y curl \
#    && apt-get -y autoclean

# nvm environment variables
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 12.18.2

# install nvm
# https://github.com/creationix/nvm#install-script
RUN curl --silent -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.2/install.sh | bash

# install node and npm
RUN source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default

# add node and npm to path so the commands are available
ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH
# ] NODE,NPM

# install bower, gulp
RUN npm install --global bower \
	gulp \
	svgo

# install ruby
RUN apt-get update \
	&& apt-get install -y -qq ruby-dev \
		make

# install compass
RUN gem install --no-rdoc --no-ri compass

EXPOSE 80
