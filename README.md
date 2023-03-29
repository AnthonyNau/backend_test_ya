## Instructions
- **copy .env.example data to .env**
- **run `composer install`**
- **run `./vendor/bin/sail up`**
- **enter to bash `docker exec -it backend-test-ya-laravel.test-1 bash`**
- **run `php artisan migrate`**
- **run `php artisan queue:work` (need for import csv job)**
- **run ` php artisan scribe:generate` for API documentation (http://localhost/docs/index.html)**
- **run ` ./vendor/bin/pest` for tests**
- **API documentation on Heroku https://infinite-stream-61745.herokuapp.com/docs/index.html**

At the root of the project there is a postman collection (backend_test_ya.postman_collection.json) and an example csv file for uploading (data_set_example.csv).
###Csv import is available for non-authorized user.
