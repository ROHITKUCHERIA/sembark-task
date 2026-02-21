# URL Shortener Application

A Laravel-based URL shortening service with role-based access control.

## Requirements

- PHP >= 8.2
- Composer
- MySQL
- Laravel 10.x

## Installation

Clone the repository
```bash
git clone <repository-url>
cd url-shortener

## composer dependencies install

```bash
composer install 
```
## SetUp Database

Create Database name sembark_task into your local using phpmyadmin or mysql work banch and then 

Open .env file and update database configuration:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sembark_task
DB_USERNAME=root
DB_PASSWORD=
```

## Run Seeder File
```bash

php artisan db:seed
```

## Clear Configuration Cache
```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

## Generate Application Key
```bash
php artisan key:generate
```

## Start the Application
```bash
php artisan serve
```
