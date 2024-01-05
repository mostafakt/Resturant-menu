#!/bin/bash
php artisan config:clear
php artisan config:cache
echo "Running command $@"
exec "$@"