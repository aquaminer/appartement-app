# App
## Prepare
```bash
composer install
cp .env.example .env
echo WWWUSER=$(id -u) >> .env 
echo WWWGROUP=$(id -g) >> .env 
yarn # or npm i
yarn run build #or npm run build
```

## Run migrations
```bash
php artisan migrate
```
## Run
```bash
docker-compose up -d
```
http://localhost/

## Import Data
```bash
php artisan import:apartments
```

## Run tests
```bash
php artisan test
```
