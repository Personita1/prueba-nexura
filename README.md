## Requirements
- **Composer** : 2.2.5 or higher
- **PHP** : 7.2.34 or higher
- **MYSQL**

## Project setup
- Clone project from
```
git clone https://github.com/Personita1/prueba-nexura
cd pruebaNexura
```
- Copy .env.example file to .env
- Create schema 'qoredb' in mysql manager program

- Install project packages
```
composer install
```
- Generate project's key
```
php artisan key:generate
```
- Migrate database
```
php artisan migrate
```
- Install passport package
```
php artisan passport:install
```
- Run project server
```
php artisan serv
```