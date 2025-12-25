# Multi-stage build for production
FROM node:18-alpine AS css-builder

WORKDIR /app

# Copy package files and install dependencies
COPY package*.json ./
RUN npm install

# Copy Tailwind config and source CSS
COPY tailwind.config.js ./
COPY app/source.css ./app/source.css
COPY app/views/ ./app/views/

# Build the CSS
RUN npm run build

# Production PHP stage
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    curl \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Copy built CSS from previous stage
COPY --from=css-builder /app/public/css/style.css ./public/css/style.css

# Configure Apache
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p app/logs \
    && chown -R www-data:www-data app/logs \
    && chmod -R 777 app/logs

# Expose port
EXPOSE 80

CMD ["apache2-foreground"]