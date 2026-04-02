#!/bin/bash

# Disable conflicting MPMs at runtime to fix AH00534
a2dismod mpm_event mpm_worker || true
a2enmod mpm_prefork || true

# Debug: List available MYSQL environment variables (names only)
echo "DEBUG: Available DB environment variables: $(env | grep MYSQL | cut -d= -f1 | tr '\n' ' ')"

# Bridge environment variables to Apache/PHP securely
# Only set if the variable is actually present in the environment
ENV_FILE="/etc/apache2/conf-enabled/railway-env.conf"
echo "# Dynamic Railway Environment" > "$ENV_FILE"

# Candidate variables for database connection
DB_VARS=("MYSQLHOST" "MYSQLDATABASE" "MYSQLUSER" "MYSQLPASSWORD" "MYSQLPORT" "MYSQL_URL" "DATABASE_URL" "DB_HOST" "DB_NAME" "DB_USER" "DB_PASS")

for var in "${DB_VARS[@]}"; do
  val="${!var}"
  if [ -n "$val" ]; then
    echo "SetEnv $var \"$val\"" >> "$ENV_FILE"
  fi
done

# Also generate the PHP bridge as a secondary fallback (NOT committed to Git)
BRIDGE_FILE="includes/db_bridge.php"
echo "<?php" > "$BRIDGE_FILE"
for var in "${DB_VARS[@]}"; do
  val="${!var}"
  if [ -n "$val" ]; then
    echo "\$_ENV['$var'] = '$val';" >> "$BRIDGE_FILE"
  fi
done
echo "?>" >> "$BRIDGE_FILE"

# Robustly set Apache port (handles both 80 or any previously set port)
PORT="${PORT:-8080}"
echo "INFO: Configuring Apache to listen on port ${PORT}..."
sed -i "s/Listen [0-9]*/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Start Apache in the foreground
apache2-foreground
