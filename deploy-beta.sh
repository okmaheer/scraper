#!/bin/bash
set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git checkout beta
    git reset --hard origin/beta
    git pull origin beta



    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # Clear cache
    php artisan config:cache
    php artisan optimize:clear
    php artisan migrate
    # Migrate database
    # php artisan migrate:fresh --seed

    # Note: If you're using queue workers, this is the place to restart them.
    # ...
    # php artisan queue:restart
    
    composer dumpautoload


# Exit maintenance mode
php artisan up

echo "Application deployed!"
