#!/bin/bash
php artisan optimize:clear
if [ "${APP_ENV^^}" == "DEV" ]
then
  if [ "$DESTROY_DB" == 1 ]
  then
    php artisan migrate:fresh --seed

  else
    php artisan migrate --seed
  fi

  if [ "$APP_DEBUG" == "true" ]
  then
    echo "Running in Debug Mode"
  fi
  php artisan storage:link
  export WEB_PORT=8080
  echo "Starting server"
  exec php artisan serve --host=0.0.0.0 --port=8080
else
  export WEB_PORT=80

  if [ "$SEED_DB" == 1 ]
  then
    php artisan migrate --seed
  else
    php artisan migrate
  fi

  php artisan storage:link

  chown -R www-data:www-data /var/www/storage

  echo 'Starting NGINX'
  nginx -g 'daemon off;' 2>&1 & NGINX_PID=$!

  echo 'Starting PHP-FPM'
  php-fpm 2>&1 & PHP_FPM_PID=$!

  exec /laravel-scheduler.sh
fi
