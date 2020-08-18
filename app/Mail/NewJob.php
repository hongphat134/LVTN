<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJob extends Mailable
{
    use Queueable, SerializesModels;

    private $users;
    private $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users = [],$info = [])
    {
        //
        $this->users = $users;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-job',$this->info)
                    ->subject('Tin tuyển dụng mới')
                    ->to('hongphat701@gmail.com')
                    ->bcc($this->users);
    }
}
