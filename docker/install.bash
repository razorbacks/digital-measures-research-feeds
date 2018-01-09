#!/bin/bash

set -e

cd /var/www/html

# dependencies
apt-get update && apt-get install -y \
    wget apache2 libapache2-mod-php php-xml php-mbstring php-zip php-mcrypt ca-certificates

# composer
EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")
if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
    >&2 echo 'ERROR: Invalid installer signature';
    exit 1;
fi
php composer-setup.php --quiet
./composer.phar install --no-dev
rm composer*

# laravel
touch ./storage/logs/laravel.log
chown -R www-data ./bootstrap/cache ./storage
php artisan route:cache

# apache
a2enmod rewrite headers deflate

# cleanup
apt-get purge -y wget
apt-get autoremove -y
apt-get clean
rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    .git* docker syndicate tests .env* Dockerfile LICENSE package.json \
    phpunit.xml README.md server.php webpack.mix.js yarn.lock
