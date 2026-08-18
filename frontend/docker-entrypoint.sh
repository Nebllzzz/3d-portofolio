#!/bin/sh
set -e
cd /app

if [ ! -d node_modules ] || [ -z "$(ls -A node_modules 2>/dev/null)" ]; then
  echo "[entrypoint] node_modules kosong — menjalankan npm install..."
  npm install
fi

exec "$@"
