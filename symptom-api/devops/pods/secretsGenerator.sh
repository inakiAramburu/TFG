#!/bin/bash

# Declarar un array asociativo llamado "variables"
declare -A variables

# Asignar las variables al "mapa"
variables["MYSQL_ROOT_PASSWORD"]=${MYSQL_ROOT_PASSWORD}
variables["MYSQL_DATABASE"]=${DATABASE_NAME}
variables["MYSQL_USER"]=${DATABASE_USER}
variables["MYSQL_PASSWORD"]=${DATABASE_PASSWORD}
variables["DATABASE_HOST"]=${DATABASE_HOST}
variables["DATABASE_PORT"]=${DATABASE_PORT}




# Función para codificar un valor en base64
base64_encode() {
    echo -n "$1" | base64
}

# Agregar el encabezado del YAML al archivo secrets.yaml
echo "apiVersion: v1" > devops/pods/secrets.yaml
echo "kind: Secret" >> devops/pods/secrets.yaml
echo "metadata:" >> devops/pods/secrets.yaml
echo "  name: symptom-api-secret" >> devops/pods/secrets.yaml
echo "type: Opaque" >> devops/pods/secrets.yaml
echo "data:" >> devops/pods/secrets.yaml

# Iterar sobre las variables y escribirlas codificadas en base64 en el archivo secrets.yaml
for key in "${!variables[@]}"; do
    encoded_value=$(base64_encode "${variables[$key]}")
    echo "  $key: $encoded_value" >> devops/pods/secrets.yaml
done

echo "Archivo secrets.yaml generado con las variables codificadas en base64."