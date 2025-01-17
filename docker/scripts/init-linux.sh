#!/bin/bash
set -e


if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction
fi


chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/bootstrap/cache

php artisan migrate

exec php artisan serve --host=0.0.0.0 --port=8000
