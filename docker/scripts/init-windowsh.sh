#!/bin/bash
set -e

if [ ! -d "vendor" ]; then
    composer install --no-interaction --no-progress
fi

mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 777 storage
chmod -R 777 bootstrap/cache

find . -type f -name "*.php" -exec dos2unix {} \;
find . -type f -name "*.json" -exec dos2unix {} \;
find . -type f -name "*.sh" -exec dos2unix {} \;

php artisan migrate

exec php artisan serve --host=0.0.0.0 --port=8000
