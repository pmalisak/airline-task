# Airline Task

## Information

This is my first project using Laravel.

I encourage you to take a look at my other Symfony project,
where I managed to demonstrate various architectural patterns.

https://github.com/pmalisak/notification-service

## Getting Started

```shell
docker compose build
docker compose up
```

Setup application:

```shell
docker exec -it airline-task-php-fpm-1 sh
composer install
php artisan migrate
php artisan db:seed
```

## Run tests

Unit and functional tests:

```shell
php artisan test
```

Coverage report:

```shell
XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-html tests/Report/
```


## Endpoints

Download postman and import `postman/airline_task.postman_collection.json`.

There are two endpoints:

1. import file
2. roster with filters
