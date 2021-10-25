# datum


####**Overview**:
 In the last 6 days I have tried to get a better output. In a short time, I have decided to split the table into 3 parts like birth year 1900 to 1950, 1951 to  2000 and 2001 to 2020. And seeded data from CSV to those tables following the birth year. Hopeful seeding data will not be out of memory limit. I have tried to handle this carefully.

I have created separate columns for year and date for filtering and indexed both columns in the tables. My thought was that every single query in the database should not extract birthday to pick date and year. So when data is seeding I have separated year and date. 

3 types of filter are implemented here. Filter by `year and date` both, `year` and `date`. There is a class named  `DBHelper` which takes a param year and returns the following table name. The Repository actually uses that table to query the data. And the query result returns within 250ms. 

In the project there are a lot of rooms to improve. We can split more tables which will provide better performance. I have written a minimum test which is not enough. 


### Installation

####Process 1:  
PostgreSQL and Redis should be pre-installed before project installation.
clone the project and move inside the directory   

`cd datum`

`composer install`

`cp .env.example .env`

update the credentials of database and redis.

RUN `php artisan key:generate`

### Migrations and Seed
Note: Before migration please check you have created a database.  
  
`php artisan migrate`   
 
`php artisan db:seed`

Finally, run     
`php artisan serve`

Application should run here: `http://127.0.0.1:8000`
