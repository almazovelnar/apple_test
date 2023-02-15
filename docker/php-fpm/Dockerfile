FROM php:7.4-fpm

# Cleaning and updating packages
RUN apt-get autoremove && apt-get autoclean && apt-get update


RUN apt-get update && apt-get install -y libzip-dev libpq-dev zlib1g-dev zip git

# Installing php-redis extension via pecl.
RUN pecl install -o -f redis && rm -rf /tmp/pear

# Enabling && configuring php extensions
RUN docker-php-ext-enable redis
RUN docker-php-ext-install pdo pdo_mysql mysqli bcmath zip

# Copy configuration files
COPY ./php.ini /usr/local/etc/php/conf.d/uploads.ini

# Installing composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --quiet

# Creating user for container.
RUN groupadd -g 1000 appuser && useradd -r -u 1000 -g appuser appuser

# Creating user && composer-cache directories.
RUN mkdir -p /home/appuser/.composer/cache/repo/https---asset-packagist.org \
    && mkdir /home/appuser/.composer/cache/files

# Giving proper permissions to user.
RUN chown -R appuser:appuser /home/appuser && chmod -R 775 /home/appuser

RUN rm -rf /home/appuser/storage/logs && mkdir -p /home/appuser/storage/logs

# Running container as user
USER appuser

ENV COMPOSER_NO_INTERACTION=1

WORKDIR /app
