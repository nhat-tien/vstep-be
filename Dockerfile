FROM php:8.3-cli-alpine as php-base

    WORKDIR /srv/laravel

    RUN apk update && \
        apk add --no-cache --virtual php_dependencies $PHPIZE_DEPS && \
        apk add --no-cache libstdc++ zip unzip libzip-dev icu-dev brotli-dev && \
        docker-php-ext-install bcmath ctype pdo_mysql pcntl intl zip pdo_sqlite && \
        pecl install swoole && \
        docker-php-ext-enable swoole && \
        apk del php_dependencies && \
        rm -rf /var/www && \
        chown -R www-data:www-data /srv/laravel

FROM php-base as laravel

    COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

    WORKDIR /srv/laravel

    COPY . .

    RUN composer install --no-dev && \
        php artisan key:generate && \
        # php artisan migrate && \
        # php artisan db:seed && \
        php artisan storage:link && \
        php artisan vendor:publish --force --tag=livewire:assets && \
        composer require laravel/octane && \
        php artisan octane:install --server="swoole"
        # rm "/srv/laravel/.env"

FROM php-base
    USER www-data

    COPY --from=laravel --chown=www-data:www-data /srv/laravel/ /srv/laravel/

    # Allow the user to specify Swoole options via ENV variables.
    ENV SWOOLE_MAX_REQUESTS "500"
    ENV SWOOLE_TASK_WORKERS "auto"
    ENV SWOOLE_WATCH $false
    ENV SWOOLE_WORKERS "auto"

    # Expose the ports that Octane is using.
    EXPOSE 8000

    # Run Swoole
    CMD if [[ -z $SWOOLE_WATCH ]] ; then \
        php artisan octane:start --server="swoole" --host="0.0.0.0" --workers=${SWOOLE_WORKERS} --task-workers=${SWOOLE_TASK_WORKERS} --max-requests=${SWOOLE_MAX_REQUESTS} ; \
    else \
        php artisan octane:start --server="swoole" --host="0.0.0.0" --workers=${SWOOLE_WORKERS} --task-workers=${SWOOLE_TASK_WORKERS} --max-requests=${SWOOLE_MAX_REQUESTS} --watch ; \
    fi

    # Check the health status using the Octane status command.
    HEALTHCHECK CMD php artisan octane:status --server="swoole"
