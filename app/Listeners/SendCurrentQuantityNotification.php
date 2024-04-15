<?php

namespace App\Listeners;

use App\Events\OutOfStockEvent;
use App\Mail\OutOfStockMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use PharIo\Version\Exception;
use Illuminate\Support\Facades\Log;

class SendCurrentQuantityNotification
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
    public function handle(OutOfStockEvent $event): void
    {
        try {
            Log::info(
                "Mail sent to " . $event->pharmacy . " about product: "
                . $event->product->name . " on event 'OutOfStockEvent'"
            );
           foreach ($event->users as $user) :
                Mail::to($user->email)->send(new OutOfStockMail($event->product, $user, $event->quantity));
           endforeach;
        } catch (Exception $exception) {
            Log::error("Mail failed: " . $exception);
        }
    }
}
