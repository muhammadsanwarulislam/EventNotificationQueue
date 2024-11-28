# Instructions of the project #
|           #                |   **Instructions**                          |
|----------------------------|---------------------------------------------|
| Step                       |  [Setup Laravel project](#q1)<br>           |
| Explanation of the process |  [Process ](#q2)<br>                         |


## Q1
# Installations process
Follow the steps mentioned below to install and run the project.

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `php artisan migrate:fresh --seed`

## Q2
# Explanation of the process

### Steps to Create Events and Listeners:

1. Generate an Event:
```php artisan make:event UserCreated```
2. Generate a Listner:
```php artisan make:listener SendUserWelcomeNotification --event=UserCreated```
3. Generate a Notification class
```php artisan make:notification UserWelcomeNotification```
