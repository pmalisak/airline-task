# Airline Task

## First time

It is my first Laravel project.

## How to install

```shell
docker compose build
docker compose up
```


```shell
docker exec -it airline-task-php-fpm-1 sh
php artisan migrate
php artisan db:seed
```
...

## How to run

Download postman and import file from `postman/` directory.


## Tests

Unit tests:

```shell
vendor/bin/phpunit
```

Coverage report:

```shell
DEBUG_MODE=coverage vendor/bin/phpunit --coverage-html tests/Report/
```
