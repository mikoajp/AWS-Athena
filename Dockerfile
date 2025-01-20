FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    netcat-traditional

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./

RUN composer install --no-scripts --no-autoloader
RUN npm install

COPY . .

RUN composer dump-autoload --optimize

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 storage bootstrap/cache

RUN npm run build


EXPOSE 8000

COPY docker/scripts/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
