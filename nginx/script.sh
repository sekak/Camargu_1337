#!/bin/bash

FPM_CONF="/etc/php/8.2/fpm/pool.d/www.conf"

# Export actual values into FPM config
grep -q "env\[DB_HOST\]" "$FPM_CONF" || echo "env[DB_HOST] = ${DB_HOST}" >> "$FPM_CONF"
grep -q "env\[DB_USER\]" "$FPM_CONF" || echo "env[DB_USER] = ${DB_USER}" >> "$FPM_CONF"
grep -q "env\[DB_PASS\]" "$FPM_CONF" || echo "env[DB_PASS] = ${DB_PASS}" >> "$FPM_CONF"
grep -q "env\[DB_NAME\]" "$FPM_CONF" || echo "env[DB_NAME] = ${DB_NAME}" >> "$FPM_CONF"
grep -q "env\[DB_CHARSET\]" "$FPM_CONF" || echo "env[DB_CHARSET] = ${DB_CHARSET}" >> "$FPM_CONF"

# Start PHP-FPM AFTER setting envs
service php8.2-fpm start

chmod 666 /run/php/php8.2-fpm.sock

composer install 

chmod -R 775 /var/www/html/public/users_pictures
chown -R www-data:www-data /var/www/html/public/users_pictures

# Start Nginx in foreground
nginx -g 'daemon off;'


