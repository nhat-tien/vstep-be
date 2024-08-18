FROM php:8.3-cli-alpine

RUN apk update && apk add --no-cache \
    zip \
    unzip \
    libzip-dev \
    icu-dev

WORKDIR /var/www/html

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install zip intl

# Copy existing application directory
COPY . .

RUN cp .env.example .env

RUN composer install --no-dev

RUN chmod +x ./setup.sh

RUN ./setup.sh

RUN php artisan octane:install --server=swoole

CMD ["php", "artisan", "octane:start", "--port=3000"]
