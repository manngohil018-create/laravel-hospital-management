FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# 🔥 IMPORTANT: permissions fix
RUN chmod -R 777 storage bootstrap/cache

# 🔥 IMPORTANT: clear cache (avoid 500 errors)
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

# Expose port
EXPOSE 10000

# 🔥 FINAL COMMAND (AUTO MIGRATE + START SERVER)
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
