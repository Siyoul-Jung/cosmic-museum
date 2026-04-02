FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set up the startup script
RUN chmod +x start.sh

# Expose port 8080 (Railway default)
EXPOSE 8080

# Execute the startup script at runtime
ENTRYPOINT ["./start.sh"]
