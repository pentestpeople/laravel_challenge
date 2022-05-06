**Assignment by Navaneetha**

*** Please note that I have done the task in my localhost (XAMPP).
*** Please run "php artisan serve" in Terminal to test api endpoints.

- GitHub Repo URL
https://github.com/pentestpeople/laravel_challenge

Installed laravel project and setup
* composer create-project laravel/laravel ticket_system

Running on Terminal
* php artisan serve

Added database name in .env file
* DATABASE=pentestpeople

* Created migrations and database seeders of Users and Tickets and migrated with seed

* Generate console commands and registered in app/console/Kernel.php and configure for specified schedule timings.
* php artisan schedule:list
* php artisan schedule:run
- OR
* php artisan command:generate_ticket
* php artisan command:process_ticket


Passport Package
* Installed and configured passport to implement api routes mentioned in doc.

Controllers and Routes
* Created controllers in App/Http/Controllers/API and written the logic for all the route methods
* added api routes in routes/api.php


UnitTests
* Written UnitTest cases for Registration,Login,Tickets,UserTickets,Stats.
* AuthenticationTest
* TicketTest
* LogoutTest
* UserTicketsTest
* StatsTest
