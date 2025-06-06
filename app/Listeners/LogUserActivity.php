<?php

namespace App\Listeners;

use App\Events\UserActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserActivity
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
    public function handle(UserActivity $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => $event->action,
            'description' => $event->description,
            'ip_address' => $event->request?->ip(),
            'user_agent' => $event->request?->userAgent(),
            'metadata' => $event->metadata,

        ]);
    }
}
