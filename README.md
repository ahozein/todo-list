# a todo-list app with Laravel api
A simple API to manage todo lists built with Laravel.

## Installation

1. Clone the repo locally


2. Install dependencies
    ```sh
    composer install
    ```

3. Generate application key (if not already generated)
    ```sh
    php artisan key:generate
    ```

4. Run database migrations
    ```sh
     php artisan migrate --seed
    ```
    
5. Install laravel-passport:
    ```sh
    php artisan passport:install
    ```
    
6. Run the dev server (the output will give the address):
    ```sh
    php artisan serve
    ```
    
7. you can test api with PostMan(https://www.postman.com/)

    
