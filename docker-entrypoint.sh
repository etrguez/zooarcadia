#!/bin/sh
# =============================================
# DOCKER ENTRYPOINT - ZOO ARCADIA
# =============================================

if [ ! -f "/var/www/html/vendor/autoload.php" ]; then
    echo "Vendor directory is missing or incomplete. Installing dependencies..."
    composer install --no-interaction --optimize-autoloader
else
    echo "Dependencies are already installed."
fi

chown -R www-data:www-data /var/www/html/vendor 2>/dev/null || true

exec "$@"
