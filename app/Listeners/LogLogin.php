<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use App\Services\ActivityLogger;

class LogLogin
{
    protected $activityLogger;
    /**
     * Create the event listener.
     */
    public function __construct(ActivityLogger $activityLogger)
    {
        $this->activityLogger = $activityLogger;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->activityLogger->log('login', null, [
            'user_id' => $event->user->id,
        ]);
    }
}
