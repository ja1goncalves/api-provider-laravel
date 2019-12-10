FROM php:7.1-apache

MAINTAINER Lourivaldo Vasconcelos <lourivaldovasconcelos@gmail.com>

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    rsyslog \
    cron \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    vim \
    nano \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd

RUN docker-php-ext-install \
    intl \
    mbstring \
    pcntl \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    zip \
    tokenizer \
    opcache

RUN docker-php-ext-enable \
    redis

# Install Xdebug
RUN curl -fsSL 'https://xdebug.org/files/xdebug-2.4.0.tgz' -o xdebug.tar.gz \
    && mkdir -p xdebug \
    && tar -xf xdebug.tar.gz -C xdebug --strip-components=1 \
    && rm xdebug.tar.gz \
    && ( \
    cd xdebug \
    && phpize \
    && ./configure --enable-xdebug \
    && make -j$(nproc) \
    && make install \
    ) \
    && rm -r xdebug \
    && docker-php-ext-enable xdebug


# Config apache vhost
COPY ./docker/apache2.conf /etc/apache2/sites-available/provider.conf
RUN a2dissite 000-default.conf && a2ensite provider.conf && a2enmod rewrite

# Change uid and gid of Apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /var/www/html
COPY . /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Install composer plugin for parallel installs
RUN composer global require hirak/prestissimo
RUN composer install

#RUN chmod 777 -R /var/www/html/tmp /var/www/html/logs

# Start supervisor: apache, cron, laravel queue
#CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
