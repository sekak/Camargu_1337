#!/bin/bash

service mariadb start

# Wait a few seconds to ensure MariaDB is ready
sleep 5

mysql -u root -p"${DB_PASS}" <<-EOSQL
  CREATE DATABASE IF NOT EXISTS \${DB_NAME}\;
  CREATE USER IF NOT EXISTS '${DB_USER}'@'%' IDENTIFIED BY '${DB_PASS}';
  GRANT ALL PRIVILEGES ON \${DB_NAME}\.* TO '${DB_USER}'@'%';
  GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '${DB_PASS}' WITH GRANT OPTION;
  ALTER USER 'root'@'localhost' IDENTIFIED BY 'med';
  FLUSH PRIVILEGES;
EOSQL

echo " Database and user created successfully."

# Keep the container running (replace this with your actual process if needed)
tail -f /dev/null