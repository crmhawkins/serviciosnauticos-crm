#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

echo "[entrypoint] Preparing application…"

# Ensure APP_KEY exists; generate only if missing so a restart does not invalidate sessions.
if [ -z "${APP_KEY:-}" ]; then
    echo "[entrypoint] WARNING: APP_KEY is empty. Generating a transient key (set APP_KEY in Coolify env to persist!)"
    export APP_KEY="base64:$(openssl rand -base64 32)"
fi

# Writable runtime directories (mounted volumes may reset perms)
mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache public/build 2>/dev/null || true
chmod -R 775 storage bootstrap/cache

# Seed persistent volumes with the bundled static content. `cp -n` leaves any
# existing file (uploaded photos, new contracts) untouched — only missing files
# from the image are written. Safe to run on every boot.
if [ -d /opt/bundled-assets-images ]; then
    mkdir -p public/assets/images
    cp -rn /opt/bundled-assets-images/. public/assets/images/ 2>/dev/null || true
    chown -R www-data:www-data public/assets/images 2>/dev/null || true
fi
if [ -d /opt/bundled-contratos ]; then
    mkdir -p public/contratos
    cp -rn /opt/bundled-contratos/. public/contratos/ 2>/dev/null || true
    chown -R www-data:www-data public/contratos 2>/dev/null || true
fi

# Storage symlink (for Storage::disk('public'))
php artisan storage:link --force || true

# Wait for DB (up to 60s) — avoids migrate racing the database service boot.
if [ -n "${DB_HOST:-}" ]; then
    echo "[entrypoint] Waiting for database at ${DB_HOST}:${DB_PORT:-3306}…"
    for i in $(seq 1 60); do
        if mysqladmin ping -h "${DB_HOST}" -P "${DB_PORT:-3306}" \
            -u "${DB_USERNAME:-root}" -p"${DB_PASSWORD:-}" --silent 2>/dev/null; then
            echo "[entrypoint] Database ready."
            break
        fi
        sleep 1
    done
fi

# Run migrations (idempotent) — can be skipped with RUN_MIGRATIONS=false
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "[entrypoint] Running migrations…"
    php artisan migrate --force --no-interaction || echo "[entrypoint] Migrations failed — continuing, check logs."
fi

# Cache config/routes/views for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[entrypoint] Boot complete. Handing off to supervisord."
exec "$@"
