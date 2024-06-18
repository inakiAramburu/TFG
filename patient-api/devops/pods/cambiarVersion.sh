#!/bin/bash

# Verifica que se haya proporcionado un parámetro
if [ $# -ne 1 ]; then
  echo "Uso: $0 <version>"
  exit 1
fi

# Captura el parámetro de la versión
version=$1

# Nombre del archivo
file="devops/pods/patient-deployment-cip.yaml"

# Verifica si el archivo existe
if [ ! -f "$file" ]; then
  echo "El archivo $file no existe."
  exit 1
fi

# Reemplaza [version] con el valor proporcionado en el archivo
sed -i "s/\[version\]/$version/g" "$file"

echo "La versión ha sido actualizada a $version en el archivo $file."
