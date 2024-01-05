#!/bin/bash
while :
do
# trigger laravel scheduler every 60s
php artisan schedule:run --verbose --no-interaction & sleep 60

done
