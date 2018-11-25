## NBA - Simulation 

This is a web application which shows "real-time" scores and statistics of NBA. In this project the first week of a NBA fixture will be simulated.

-----

### Installation

1. Clone the repo
	- git clone [repo_URL]

2. Update the composer to install related dependencies
	- composer update

3. Create application key
	- php artisan key:generate

4. Create DB and change the DB configuration in .env file

5. Migrate tables and db seeding
	- php artisan migrate
	- php artisan db:seed

6. Start the application
	- php artisan serve

7. Create account by clicking "Register"

### Game starts automatically when logged in successfully

### "Start NBA Week" button is disabled by default, enabled when current matches are completed