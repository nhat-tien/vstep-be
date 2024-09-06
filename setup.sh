#!/bin/sh

php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan vendor:publish --force --tag=livewire:assets

