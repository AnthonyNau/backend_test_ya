## Instructions
- **copy .env.example data to .env**
- **run `./vendor/bin/sail up`**
- **enter to bash `docker exec -it backend-test-ya-laravel.test-1 bash`**
- **run `composer install`**
- **run `php artisan migrate`**
- **run `php artisan queue:work` (need for import csv job)**

At the root of the project there is a postman collection (backend_test_ya.postman_collection.json) and an example csv file for uploading (data_set_example.csv).
###Csv import is available for non-authorized user.
