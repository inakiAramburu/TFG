#!/bin/bash
check_variable() {
    if [ -z "${!1}" ]; then
        echo "ERROR: La variable de entorno $1 no está configurada."
        exit 1
    fi
}

check_variable "MYSQL_ROOT_PASSWORD"
check_variable "MYSQL_DATABASE"
check_variable "MYSQL_USER"
check_variable "MYSQL_PASSWORD"

##### MySQL #####
service mysql start

mysql --user=root -pconfPASSWORD <<_EOF_
CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;
CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';
FLUSH PRIVILEGES;
_EOF_


#fichero init.sql
echo "">> /tmp/init.sql
mysql -u root -pconfPASSWORD < /tmp/init.sql
rm /tmp/init.sql


#Modo seguro de MySQL
mysql <<_EOF_
ALTER USER 'root'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PASSWORD';
DELETE FROM mysql.user WHERE User=''; #elimina usuarios anonimos
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1'); #elimina usuarios root remotos
DROP DATABASE IF EXISTS test; #elimina la base de datos test
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%'; #elimina los permisos de la base de datos test
FLUSH PRIVILEGES; #recarga los privilegios
_EOF_

/opt/venv/bin/python3.12 /opt/src/manage.py migrate



##### Apache2 #####
source /etc/apache2/envvars 
/usr/sbin/apache2 -D FOREGROUND





exec "$@"