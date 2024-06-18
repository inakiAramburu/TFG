#!/bin/bash





mysql --user=root -pconfPASSWORD <<_EOF_
CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;
CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';
FLUSH PRIVILEGES;

_EOF_






echo "">> /tmp/init.sql

#mysql -u root -pconfPASSWORD < /tmp/init.sql


#Modo seguro de MySQL
mysql <<_EOF_
ALTER USER 'root'@'localhost' IDENTIFIED BY '$MYSQL_ROOT_PASSWORD';
DELETE FROM mysql.user WHERE User=''; #elimina usuarios anonimos
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1'); #elimina usuarios root remotos
DROP DATABASE IF EXISTS test; #elimina la base de datos test
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%'; #elimina los permisos de la base de datos test
FLUSH PRIVILEGES; #recarga los privilegios
_EOF_



#con unset no me deja borrar las variables

#unset confPASSWORD
#unset MYSQL_ROOT_PASSWORD

rm /tmp/init.sql
#rm /tmp/config.sh

# Inicia tu aplicación o comando principal
#exec "$@"
