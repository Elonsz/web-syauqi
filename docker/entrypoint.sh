#!/bin/bash
set -e

# Port adjustment for cloud providers like Render (Render provides $PORT, e.g. 10000)
if [ -n "$PORT" ]; then
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:$PORT>/g" /etc/apache2/sites-available/000-default.conf
fi

# Ensure storage & database directory permissions
mkdir -p /var/www/html/storage/framework/{sessions,views,cache} /var/www/html/storage/logs /var/www/html/bootstrap/cache /var/www/html/database
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Create SQLite database file if DB_CONNECTION is sqlite
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Ensure valid APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY belum disetel, membuat APP_KEY baru..."
    export APP_KEY=$(php artisan key:generate --show)
fi

# Storage symlink
php artisan storage:link || true

# Run database migrations and seeding
echo "Menjalankan migrasi database..."
php artisan migrate --force

echo "Memastikan akun admin dan data awal tersedia..."
php artisan db:seed --force || true

# Cache configurations for speed in production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Web Yayasan Cahaya Amanah Ar-Raudhah siap! Memulai web server..."
exec apache2-foreground
