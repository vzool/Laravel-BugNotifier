<?php

namespace Vzool\BugNotifier\Drivers;

use Vzool\BugNotifier\Message;

interface DriverInterface
{
    /**
     * Handle the notification message.
     *
     * @param \Vzool\BugNotifier\Message $message
     *
     * @return void
     */
    public function handle(Message $message);
}
