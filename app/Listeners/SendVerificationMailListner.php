<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PharIo\Version\Exception;

class SendVerificationMailListner
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
    public function handle(UserCreatedEvent $event): void
    {
        try {
            Log::info('User Created successfully :' . $event->user->name);
            Mail::to($event->user->email)->send(new UserCreated());
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
