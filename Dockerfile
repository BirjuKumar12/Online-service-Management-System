# Use official PHP + Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install mysqli extension (for database)
RUN docker-php-ext-install mysqli

# Copy all project files to Apache server directory
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose Apache default port
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]