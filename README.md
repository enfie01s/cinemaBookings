<p align="center"><img src="http://aristia.net/fantastic-films.png" width="300"></p>

## About Fantastic Films

This is a simple project I created while learning [Laravel](https://laravel.com/). It is currently an API for booking a movie showing (and includes the usual CRUD functionality). I will be adding more to this later as I progress.

## Libraries used
There are two libraries I have used in this project for data sanitization and tidy forms, they are as follows:

- [Waavi/Sanitizer](https://github.com/Waavi/Sanitizer)
- [Laravel Collective HTML](https://github.com/LaravelCollective/html)

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. They believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Useage

The front end has not been fully developed as this is currently more of a back end project but you can view a very basic page listing the movies at the endpoint /movies.

The API endpoints for returning a list or single item are as follows:

- /api/movies
- /api/movie/1
- /api/customers
- /api/customer/1
- /api/showings
- /api/showing/1
- /api/bookings
- /api/booking/1

## Installation

First clone the repository 
```bash
git clone https://github.com/enfie01s/cinemaBookings.git
```

Navigate to the directory which was created and install the dependencies
```bash
composer install
```

Set up your database and enter the connection details into the **.env** file located in the root directory.

Now you will need to run the migrations
```bash
php artisan migrate
```

Finally seed the database with the test data
```bash
php artisan db:seed
```
