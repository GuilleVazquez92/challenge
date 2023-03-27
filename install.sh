composer install
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan view:clear
php artisan migrate --seed
php artisan passport:install
