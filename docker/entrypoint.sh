#!/bin/bash

# If .env doesn't exist, copy from example
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key if not set
php artisan key:generate --force 2>/dev/null || true

# If PORT env is set (Render, Railway, etc.), update Apache to listen on that port
if [ -n "$PORT" ]; then
    echo "==> Configuring Apache to listen on port $PORT"
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/*:80/*:$PORT/g" /etc/apache2/sites-available/*.conf
    sed -i "s/:80/:$PORT/g" /etc/apache2/sites-available/*.conf
fi

# Cache configuration for production
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Run migrations (don't block startup if DB is unavailable)
echo "==> Running migrations..."
php artisan migrate --force 2>/dev/null || echo "==> WARNING: Migrations failed, skipping..."

# Create storage link if not exists
php artisan storage:link 2>/dev/null || true

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

echo "==> Starting Apache on port ${PORT:-80}..."
exec "$@"
