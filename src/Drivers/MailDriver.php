<?php

namespace vzool\BugNotifier\Drivers;

use Illuminate\Support\Facades\Mail;
use vzool\BugNotifier\Message;
use vzool\BugNotifier\Mail\BugMail;

class MailDriver extends Driver implements DriverInterface
{
    /**
     * Send e-mail message.
     *
     * @param \vzool\BugNotifier\Message $message
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
