#!/bin/bash
set -e

echo "Deploying application ..."

# Enter maintenance mode
#(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git checkout dev
    git reset --hard origin/dev
    git pull origin dev

    # cd /var/www/html
    # cp -R /var/repos/aspca/* /var/www/html

    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # Clear cache
    php artisan config:clear
    php artisan cache:clear
    php artisan optimize:clear

    # Migrate database
    php artisan migrate

    # Note: If you're using queue workers, this is the place to restart them.
    # ...
    # php artisan queue:restart
    # nohup php artisan queue:work --daemon > storage/logs/laravel.log &
    
    composer dumpautoload


# Exit maintenance mode
php artisan up

echo "Application deployed!"