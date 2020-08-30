<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfferSeeker extends Mailable
{
    use Queueable, SerializesModels;

    private $email_list;
    private $info;
    public $reply_to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_list = [],$info = [],$reply_to = '')
    {
        //
        $this->email_list = $email_list;
        $this->info = $info;
        $this->reply_to = $reply_to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.offerseekers',$this->info)
                ->subject('Thư ngỏ ý từ Nhà tuyển dụng')
                ->to(config('mail.username'))                
                ->bcc($this->email_list)
                ->replyTo($this->reply_to);
    }
}
