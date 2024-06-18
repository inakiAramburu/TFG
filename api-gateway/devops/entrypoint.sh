#!/bin/bash

cd /var/www


chgrp -R www-data /var/www/

chmod g-w -R /var/www/

chmod g+w  -R /var/www/storage
chmod u+w g+w -R /var/www/vendor


#composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

composer install



exec "$@"
