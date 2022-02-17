<?php

namespace App\Mail;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = Arr::get($this->data, 'subject');
        $message = Arr::get($this->data, 'message');

        $this->from(config('mail.from.address'), config('app.name'))
            ->subject($subject)
            ->markdown('emails.admin.BroadcastMessage', compact('message'));
    }
}
