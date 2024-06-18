#!/bin/sh

# Verificar si se proporciona el dominio como variable de entorno
if [ -z "$DOMINIO" ]; then
  echo "Error: Debes proporcionar el dominio a través de la variable de entorno \$DOMINIO"
  exit 1
fi

# Copiar certificados desde /certificates/ si existen
if [ -f "/certificates/minica-key.pem" ] && [ -f "/certificates/minica.pem" ]; then
  cp /certificates/minica-key.pem /go/minica/
  cp /certificates/minica.pem /go/minica/
fi


# Crear el certificado con el dominio proporcionado
minica --domains $DOMINIO

# crear carpeta para el dominio
mkdir -p /certificates/$DOMINIO


#mover los certificados a certificates y renombrarlos 
mv /go/minica/$DOMINIO/key.pem /certificates/$DOMINIO/$DOMINIO-key.pem
mv /go/minica/$DOMINIO/cert.pem /certificates/$DOMINIO/$DOMINIO-cert.pem

if [ ! -f "/certificates/minica-key.pem" ] || [ ! -f "/certificates/minica.pem" ]; then
  cp /go/minica/minica-key.pem  /certificates/
  cp /go/minica/minica.pem /certificates/ 
fi




# Ejecutar el comando por defecto
exec "$@"
