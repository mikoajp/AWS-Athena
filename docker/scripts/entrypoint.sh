#!/bin/bash

chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

npm install
npm run build
php artisan session:table
php artisan migrate

apache2-foreground
