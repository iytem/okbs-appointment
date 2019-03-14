#!/usr/bin/env sh

echo "okbs sh is running"

chown -R www-data $PROJECT_DIR

echo "Starting Okbs Appointments production server.."

exec docker-php-entrypoint apache2-foreground

exec $@