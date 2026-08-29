#!/bin/bash

# If .env doesn't exist, copy from example
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Fallback & normalization for Render environment variables
if [ -n "$BS_DB_HOST" ] && [ -z "$DB_HOST" ]; then
    export DB_HOST="$BS_DB_HOST"
fi
if [ -n "$BS_DB_DATABASE" ] && [ -z "$DB_DATABASE" ]; then
    export DB_DATABASE="$BS_DB_DATABASE"
fi
if [ -n "$DB_BUSINESS_DATABASE" ] && [ -z "$DB_DATABASE" ]; then
    export DB_DATABASE="$DB_BUSINESS_DATABASE"
fi
if [ -n "$BS_DB_USERNAME" ] && [ -z "$DB_USERNAME" ]; then
    export DB_USERNAME="$BS_DB_USERNAME"
fi
if [ -n "$BS_DB_PASSWORD" ] && [ -z "$DB_PASSWORD" ]; then
    export DB_PASSWORD="$BS_DB_PASSWORD"
fi
if [ -n "$BS_DB_PORT" ] && [ -z "$DB_PORT" ]; then
    export DB_PORT="$BS_DB_PORT"
fi
if [ -n "$RESEND_KEY" ] && [ -z "$RESEND_API_KEY" ]; then
    export RESEND_API_KEY="$RESEND_KEY"
fi

# Ensure databaseasp.net uses public endpoint
if [[ "$DB_HOST" == *".databaseasp.net" ]] && [[ "$DB_HOST" != *".public."* ]]; then
    export DB_HOST="${DB_HOST/.databaseasp.net/.public.databaseasp.net}"
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

# Create storage link if not exists
php artisan storage:link 2>/dev/null || true

# Fix permissions
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# Run migrations & seeders in background so Apache port opens immediately (avoids 502 Bad Gateway)
(
    sleep 1
    echo "==> Running migrations & seeders in background..."
    php artisan migrate --force --no-interaction 2>/dev/null && php artisan db:seed --force --no-interaction 2>/dev/null || echo "==> WARNING: Migrations/Seeders failed or DB unreachable, skipping..."
) &

echo "==> Starting Apache on port ${PORT:-80}..."
exec "$@"
