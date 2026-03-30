# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# 1. Install system dependencies & PHP extensions required by CodeIgniter 4
RUN apt-get update && apt-get install -y 
    git 
    curl 
    unzip 
    zip 
    libzip-dev 
    libicu-dev 
    libpng-dev 
    && docker-php-ext-install 
    intl 
    zip 
    mysqli 
    gd

# 2. Configure Apache to use the 'public' directory
RUN echo '<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --no-dev --prefer-dist

# 5. Copy application source
COPY . .

# 6. Set permissions for the writable directory
RUN chown -R www-data:www-data writable

# Expose port 80 and start apache
EXPOSE 80
