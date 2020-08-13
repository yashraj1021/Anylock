# AnyLock Locker Management System

## About This Project
 
AnyLock Locker Management System is a web application to track the rental of lockers. 
With this system, you can assign users and administrators to rent, checkout, and manage lockers of any type. 
The program was made to be very generic, so that it can be used in almost any locker rental scheme. AnyLock was created to help people and businesses 
get a free solution to manage their locker systems. It is free to use and manipulate however you please under the MIT license. 
 

This application was developed by the Summer 2020 Open Source team at Portland State University, consisting of: 

- [Dmitri Murphy](https://github.com/Dmitri-2)
- [Davis Giang](https://github.com/giangdavis)
- [Alexander Wallace](https://github.com/AlexAtPSU)
- [Paul Hubbard](https://github.com/phubbard67)

## Code Libraries and Resources Used  

- Laravel PHP Framework _(MIT License)_
- Bootstrap CSS Library _(MIT License)_
- Google Fonts _(Open Font License)_
- JQuery _(MIT License)_
- FontAwesome _([Free License](https://fontawesome.com/license/free))_
- Background Locker Photo by moren hsu ([Unsplah License](https://unsplash.com/license)) ([Photo](https://unsplash.com/photos/VLaKsTkmVhk))

**Note:** This project was built using the base installation of the Laravel framework. 
Most of the code that was written by the project team exists in the following directories: 

- `app/Http/Controllers` and `app/Http/Service` for the PHP code handling the requests 
- `resources/views`  for the HTML page tempates
- `routes/web.php` and `routes/api.php`for web routes  
 
 Code that was auto-generated by Laravel when creating the project 
 has been marked with a comment at the top of the file. 

## Running the Project 

### Prerequisites

- PHP 7.4+ (https://www.php.net/)
- Composer (https://getcomposer.org/)
- Git 
- A Postgres instance 

### Installation Steps (local) 

1. Clone the project from this repository 
2. `cd AnyLock-LS` and run `composer install` (see https://getcomposer.org/doc/01-basic-usage.md)
3. Run `cp .env.example .env` to make a copy of the .env file 
4. In the `.env` file, fill in the database fields (starting with DB_CONNECTION)
5. Run `php artisan key:generate` to generate an application key 
6. Run `php artisan migrate` to build the database tables 
7. Run `php artisan serve` to serve the project locally

For more information, or for information about hwow to deploy the application to a production webserver,
please see the [Laravel installation instructions](https://laravel.com/docs/7.x/installation). 

### Set-Up Steps

Once you have your project running locally (or in production), do the following to set up the application: 

1. Create your account
2. Set your account as an administrator through Postgres (run `UPDATE users SET is_admin='t' WHERE id=1;`)
3. Visit http://127.0.0.1:8000/admin/settings to set your organization name and tagline 
4. Visit http://127.0.0.1:8000/admin/locations/overview to create a new location, and specify the number of lockers you have
5. You're all set to rent lockers!

## Usage Instructions / Overview 

### Types of Users 
There are 3 distinct categories of users we have defined: 
1. Public users (not authenticated)
2. Registered users (authenticated, not admins)
3. Administrator users (authenticated, admin)

Each of these 3 types of users are shown different versions of the sidebar and have access to different pages in the application. 

### Renting a Locker 

To rent a locker, a user should go to the "Rent a Locker" page from the sidebar and follow onscreen instructions. 

### Confirming a Locker Rental 

To confirm a locker rental, a user must come in person to a user with administrator access so that the administrator can 
physically check the user into their locker (by removing the default lock and allowing the user to put their own lock on). 
The administrator should find the user in the Pending Rentals page, and follow onscreen instructions to confirm their rental.  


## The following two sections are taken from the Laravel Readme file: 

### About Laravel (framework used for this project)

Laravel is a PHP web application framework with expressive, elegant syntax. 
We believe development must be an enjoyable and creative experience to be truly fulfilling. 
Laravel takes the pain out of development by easing common tasks used in many web projects. 
Laravel is accessible, powerful, and provides tools required for large, robust applications.


### Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Contributing

Please review the [CONTRIBUTING.md](https://github.com/Dmitri-2/AnyLock-LS/blob/master/CONTRIBUTING.md) file for instructions. 

## Code of Conduct

In order to ensure that our community is welcoming to all, please review and abide by the [Code of Conduct](https://github.com/Dmitri-2/AnyLock-LS/blob/master/CODE_OF_CONDUCT.md).


## License

This code is licensed under the [MIT license](./LICENSE).
