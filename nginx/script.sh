#!/bin/bash

# Install Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install phpmailer lib
composer require phpmailer/phpmailer

FPM_CONF="/etc/php/8.2/fpm/pool.d/www.conf"

# Export actual values into FPM config, because php-fpm cannot gets directly env from container 
grep -q "env\[DB_HOST\]" "$FPM_CONF" || echo "env[DB_HOST] = ${DB_HOST}" >> "$FPM_CONF"
grep -q "env\[DB_USER\]" "$FPM_CONF" || echo "env[DB_USER] = ${DB_USER}" >> "$FPM_CONF"
grep -q "env\[DB_PASS\]" "$FPM_CONF" || echo "env[DB_PASS] = ${DB_PASS}" >> "$FPM_CONF"
grep -q "env\[DB_NAME\]" "$FPM_CONF" || echo "env[DB_NAME] = ${DB_NAME}" >> "$FPM_CONF"
grep -q "env\[DB_CHARSET\]" "$FPM_CONF" || echo "env[DB_CHARSET] = ${DB_CHARSET}" >> "$FPM_CONF"

# Start PHP-FPM AFTER setting envs
service php8.2-fpm start

#enable Nginx communicates with PHP-FPM.
chmod 666 /run/php/php8.2-fpm.sock

composer install 

chmod -R 775 /var/www/html/public/users_pictures
chown -R www-data:www-data /var/www/html/public/users_pictures

# Start Nginx in foreground
nginx -g 'daemon off;'


