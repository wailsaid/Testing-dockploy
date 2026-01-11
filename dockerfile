FROM php:8.3-fpm-alpine

# System deps
RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    git \
    libpng \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nodejs \
    npm

# PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Backend deps
RUN composer install --no-dev --optimize-autoloader

# Frontend build (THIS FIXES YOUR ERROR)
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisord.conf

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
