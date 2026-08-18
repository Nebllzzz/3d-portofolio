#!/bin/sh
set -e

cd /var/www/html

# Bind mount bisa datang tanpa vendor/ (mis. clone baru).
if [ ! -f vendor/autoload.php ]; then
  echo "[entrypoint] vendor/ kosong — menjalankan composer install..."
  composer install --no-interaction --prefer-dist --no-progress
fi

if [ ! -f .env ]; then
  echo "[entrypoint] .env belum ada — menyalin dari .env.example"
  cp .env.example .env
fi

# APP_KEY dibaca dari environment compose kalau .env belum punya.
if ! grep -q '^APP_KEY=base64:' .env && [ -z "$APP_KEY" ]; then
  php artisan key:generate --no-interaction
fi

mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

echo "[entrypoint] menunggu MySQL di ${DB_HOST:-db}:${DB_PORT:-3306}..."
until php -r 'exit(@fsockopen(getenv("DB_HOST") ?: "db", (int)(getenv("DB_PORT") ?: 3306)) ? 0 : 1);'; do
  sleep 2
done

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction

# Symlink relatif (bukan `artisan storage:link` yang absolut) supaya tetap valid
# di host maupun di container — folder backend/ ini di-bind mount ke keduanya.
if [ ! -e public/storage ]; then
  mkdir -p storage/app/public
  ln -s ../storage/app/public public/storage
fi

# Bersihkan cache config/route supaya override env compose kepakai.
php artisan config:clear --no-interaction
php artisan route:clear --no-interaction
php artisan view:clear --no-interaction

exec "$@"
