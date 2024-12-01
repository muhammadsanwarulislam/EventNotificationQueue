# Instructions of the project #
|           #                |   **Instructions**                          |
|----------------------------|---------------------------------------------|
| Setup Laravel Project      |  [Follow Setup Instructions](#q1)<br>           |
| Explanation of Process |  [Understand the Event-Driven Workflow](#q2)<br>                         |


## Q1
# Setup Laravel Project
Follow the steps mentioned below to install and run the project.

1. Clone or download the repository.
2. Go to the project directory and run `composer install`.
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`.
4. Update the database name and credentials in `.env` file.
5. Run the command `php artisan migrate:fresh --seed`.
6. Update Mailtrap credentials in ```.env``` to send notifications via email.

## Q2
# Understanding the Event-Driven Workflow
This project demonstrates how to leverage Laravel's Events, Listeners, and Notifications effectively to handle asynchronous tasks such as sending notifications after a user is created. Below is a step-by-step guide to set up events, listeners, and notifications.

### Steps to Create Events and Listeners:

1. **Create an Event**
   - Generate an event to encapsulate the data and logic:
   - ```php artisan make:event UserCreated```
3. **Create a Listner**
    - Generate a listener that responds to the event:
    - ```php artisan make:listener SendUserWelcomeNotification --event=UserCreated```

      ```
      public function handle(UserCreated $event): void
      {
          // $event->user->notify(new UserWelcomeNotification());
          Notification::send(notifiables: $event->user, notification: new UserWelcomeNotification());
      }
      ```
5. **Create a Notification**
    - Generate a notification class to handle user communication:
    - ```php artisan make:notification UserWelcomeNotification```
    - Use the ```toMail()``` method to send an email notification. Optionally, you can also save the notification in the database using ```via()```:
       ```
       public function via(object $notifiable): array
       {
           return ['mail', 'database'];
       }
       ```

6. **Create Notification and Job Table**
    - Laravel provides a default ***notifications*** and ***jobs*** tables to store notifications sent to users and events. To create this table, run the following:
    - ```php artisan make:notifications-table```
    -  ```php artisan make:queue-table```

7. **Workflow**
   - When a user is created, the ```UserCreated``` event is triggered (dispatched by the model).
   - The ```SendUserWelcomeNotification``` listener processes the event asynchronously (using queues).
   - The listener sends a ```UserWelcomeNotification``` via email and stores it in the database.

8. **Queue Processing**
    - Run queue workers to handle asynchronous listeners:
    - ```php artisan queue:work```
  
10. **Key Points**
   
   1. **No Need to Register in** ```EventServiceProvider```:

      - Starting with Laravel 11, events and listeners are automatically discovered. There’s no need to manually register them in the ```EventServiceProvider```.
      
   2. **Automatic Listener Directory Scanning:**

      - Laravel 11 defaults to scanning the ```app/Listeners``` directory.
      - **If your listeners are in a custom directory, you can specify it in bootstrap/app.php like this:**
      ```app()->withEvents(discover: [__DIR__.'/../app/CustomListeners',]);```

