<?php

namespace Vzool\BugNotifier\Drivers;

use Illuminate\Support\Facades\Mail;
use Vzool\BugNotifier\Message;
use Vzool\BugNotifier\Mail\BugMail;

class MailDriver extends Driver implements DriverInterface
{
    /**
     * Send e-mail message.
     *
     * @param \Vzool\BugNotifier\Message $message
     *
     * @return void
     */
    public function handle(Message $message)
    {
        $view = $this->config('view');
        $addresses = $this->getEmailAddresses();
        $subject = $message->getTitle();
        $body = $message->getBody();
        $origin = $_SERVER['HTTP_HOST'];

        Mail::to($addresses)
            ->queue(new BugMail($view, $subject, $body, $origin));
    }

    /**
     * Get e-mail address list.
     *
     * @return array
     */
    private function getEmailAddresses()
    {
        $address = $this->config('to.address');

        if ($address) {
            return [$address];
        }

        return $this->config('to');
    }
}
