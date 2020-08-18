<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Applied extends Mailable
{
    use Queueable, SerializesModels;

    private $to_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_email = '')
    {
        //
        $this->to_email = $to_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.applied')
                ->subject('Hồ sơ xin việc')
                ->to($to_email ? $to_email : 'conbaba999990@gmail.com');
    }
}
