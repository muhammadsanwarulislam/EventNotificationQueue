<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Support\Facades\Notification;

class SendUserWelcomeNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        // $event->user->notify(new UserWelcomeNotification());
        Notification::send(notifiables: $event->user, notification: new UserWelcomeNotification());
    }
}
