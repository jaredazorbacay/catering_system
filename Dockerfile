# Use official PHP image with mysqlnd support
FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    libssl-dev \
    curl \
    && docker-php-ext-install pdo_mysql mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear caches and prepare Laravel
RUN php artisan optimize:clear

# Expose port
EXPOSE 8080

# Start Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT