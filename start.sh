#!/bin/bash

# Wait for MySQL to be ready
until mysqladmin ping -h"$DB_HOST" --silent; do
  echo "Waiting for MySQL..."
  sleep 2
done

echo "Starting Laravel setup..."

# Clean caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Re-cache (optional in production)
php artisan config:cache
php artisan route:cache

# Fresh install tasks
composer install --no-interaction
php artisan migrate --force
php artisan storage:link || true
php artisan key:generate || true

echo "Laravel is ready."

# Start Apache
exec apache2-foreground
