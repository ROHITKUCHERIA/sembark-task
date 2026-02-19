# URL Shortener Application

A Laravel-based URL shortening service with role-based access control.

## Requirements

- PHP >= 8.2
- Composer
- SQLite
- Laravel 10.x

## Installation

Clone the repository
```bash
git clone <repository-url>
cd url-shortener
```
## SetUp Database

Open .env file and update database configuration:

DB_CONNECTION=sqlite
DB_DATABASE=C:\Users\RohitKucheria\Downloads\url-shortner\url-shortner\database\database.sqlite      -- absolute path

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
