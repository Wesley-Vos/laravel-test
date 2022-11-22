<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendProductCreatedNotifications
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach (User::all() as $user)
        {
            $user->notify(new NewProduct($event->product));
        }
    }
}
