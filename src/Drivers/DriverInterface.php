<?php

namespace vzool\BugNotifier\Drivers;

use vzool\BugNotifier\Message;

interface DriverInterface
{
    /**
     * Handle the notification message.
     *
     * @param \vzool\BugNotifier\Message $message
     *
     * @return void
     */
    public function handle(Message $message);
}
