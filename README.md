# Instructions of the project #
|           #                |   **Instructions**                          |
|----------------------------|---------------------------------------------|
| Setup Laravel Project      |  [Follow Setup Instructions](#q1)<br>           |
| Explanation of Process |  [Understand the Event-Driven Workflow](#q2)<br>                         |


## Q1
# Setup Laravel Project
Follow the steps mentioned below to install and run the project.

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `php artisan migrate:fresh --seed`

## Q2
# Understanding the Event-Driven Workflow
This project demonstrates how to use Laravel's Events, Listeners, and Notifications effectively. Here's the step-by-step guide:

### Steps to Create Events and Listeners:

1. **Create an Event**
   Generate an event to encapsulate the data and logic:
```php artisan make:event UserCreated```
2. **Create a Listner**
   Generate a listener that responds to the event:
```php artisan make:listener SendUserWelcomeNotification --event=UserCreated```
3. **Create a Notification**
   Generate a notification class to handle user communication:
```php artisan make:notification UserWelcomeNotification```
4. Workflow
   - When a user is created, the ```UserCreated``` event is triggered (dispatched by the model).
   - The ```SendUserWelcomeNotification``` listener processes the event asynchronously (using queues).
   - The listener sends a ```UserWelcomeNotification``` via email and stores it in the database.
