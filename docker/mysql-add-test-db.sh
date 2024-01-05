#!/bin/bash
set -e

# If command starts with an option, prepend mysqld
# This allows users to add command-line options without
# needing to specify the "mysqld" command
if [ "${1:0:1}" = '-' ]; then
	set -- mysqld "$@"
fi

# Check if entrypoint (and the container) is running as root
if [ $(id -u) = "0" ]; then
	is_root=1
	install_devnull="install /dev/null -m0600 -omysql -gmysql"
	MYSQLD_USER=mysql
else
	install_devnull="install /dev/null -m0600"
	MYSQLD_USER=$(id -u)
fi

# To avoid using password on commandline, put it in a temporary file.
# The file is only populated when and if the root password is set.
PASSFILE=$(mktemp -u /tmp/mysql-XXXXXXXXXX)
$install_devnull "$PASSFILE"
# Put the password into the temporary config file
cat >"$PASSFILE" <<EOF
      [client]
      password="${MYSQL_ROOT_PASSWORD}"
EOF

mysql=( mysql --defaults-extra-file="$PASSFILE" -uroot -hlocalhost --init-command="SET @@SESSION.SQL_LOG_BIN=0;")


"${mysql[@]}" <<-EOSQL
	CREATE DATABASE IF NOT EXISTS ${MYSQL_TEST_DATABASE};
  CREATE USER IF NOT EXISTS '${MYSQL_READONLY_USER}'@'%' IDENTIFIED BY '${MYSQL_READONLY_PASSWORD}';
  CREATE USER IF NOT EXISTS '${MYSQL_TEST_USERNAME}'@'%' IDENTIFIED BY '${MYSQL_TEST_PASSWORD}';
  GRANT SELECT ON \`${MYSQL_DATABASE}\`.* TO '${MYSQL_READONLY_USER}'@'%';
  GRANT SELECT ON \`${MYSQL_TEST_DATABASE}\`.* TO '${MYSQL_READONLY_USER}'@'%';  
  GRANT ALL ON \`${MYSQL_TEST_DATABASE}\`.* TO '${MYSQL_TEST_USERNAME}'@'%';
  FLUSH PRIVILEGES;
EOSQL

rm "${PASSFILE}"