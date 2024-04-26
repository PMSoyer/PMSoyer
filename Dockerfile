FROM php:7.4-fpm-alpine

RUN apk update && apk add \
    wget \
    vim \
    git \
    tzdata

ENV TZ="UTC"

RUN docker-php-ext-install pdo pdo_mysql opcache && docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

COPY public/docker/php.ini /usr/local/etc/php/conf.d/php.ini

COPY --chown=www:www . /var/www

WORKDIR /var/www

RUN composer install

EXPOSE 9000

CMD ["php-fpm"]