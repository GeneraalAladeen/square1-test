# Square1 Test

## Introduction

This is a simple blog application built with laravel for a technical test. The application uses blade templates and Tailwind css. Repository Pattern was the Design pattern Choice. Laravel Breeze was used to handle authentication.

## Installation

Clone the repository

    git clone https://github.com/GeneraalAladeen/square1-test.git

Switch to the repo folder

    cd square1-test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Task Scheduling

- This application makes use of laravel task scheduler to schedule the command responsible for fetch posts from external API

- First ensure the `POST_ENDPOINT` env variable is set to the new posts endpoint

    `POST_ENDPOINT=https://candidate-test.sq1.io/api.php`
  
- The task scheduler can be started locally by running the command

    php artisan schedule:work


- Alternatively, the scheduled command can be run from the command line by running the custom artisan command

    php artisan post:fetch



## Testing

To run application tests

    php artisan test