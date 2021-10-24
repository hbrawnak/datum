# datum

PostgreSQL and Redis should be pre-installed before project installation.

### Installation process

clone the project and move inside the directory   

`cd datum`

`composer install`

`cp .env.exampla .env`

update the credentials of database and redis.

### Migrations and Seed
`php artisan migrate`   
 
`php artisan db:seed`

Finally, run     
`php artisan serve`
