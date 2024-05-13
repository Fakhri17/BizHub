## Requirement

- PHP 8.3
- MySql 8

## Clone And Installation

#### Please make sure you have database before clone this repo. `Database Ex: Bizhub`

```
1.Run git clone https://github.com/Fakhri17/bizhub.git
2.Run composer install
3.Run cp .env.example .env
4.Run php artisan key:generate
5.Run php artisan migrate
6.Run php artisan serve
```
## Create user admin

run 
```sh
php artisan make:filament-user
```
Nama : Admin

Email : admin@gmail.com

password: admin123

## Filament

You can access filament dashboard with url `/admin/login`

- email : admin@gmail.com
- password: admin123

### Thanks Riyan
