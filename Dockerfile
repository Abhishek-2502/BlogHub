FROM php:8.2-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www

# Copy start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www

# Point Apache to public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|' /etc/apache2/sites-available/000-default.conf

# Enable .htaccess support
RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www && \
    echo "<Directory /var/www/public>\n\tAllowOverride All\n</Directory>" >> /etc/apache2/apache2.conf

ENTRYPOINT ["/start.sh"]

EXPOSE 80
