<?php

namespace vzool\BugNotifier\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $view;
    public $subject;
    public $body;
    public $origin;

    /**
     * Create a new message instance.
     *
     * @param Illuminate\View\View $view
     * @param string $subject
     * @param string $body
     *
     * @return void
     */
    public function __construct($view, $subject, $body, $origin = null)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->body = $body;
        $this->body = $body;
        $this->origin = $origin ? ' @ ' . $origin : '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
            ->subject($this->subject . $this->origin);
    }
}
