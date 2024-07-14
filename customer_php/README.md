## How to run
- cp .env.example .env
- php artisan key:generate
- change value env DB_DATABASE, DB_USERNAME, DB_HOST
- docker-compose up -d
- php artisan migrate
- php artisan db:seed

## How to test
- ./vendor/bin/pest
