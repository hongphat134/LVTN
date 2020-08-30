<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelJob extends Mailable
{
    use Queueable, SerializesModels;

    private $email_list;
    private $info;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_list = [], $info = [])
    {
        //
        $this->email_list = $email_list;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.cancel-job',$this->info)
                ->subject('Tạm dừng tuyển dụng')
                ->to(config('mail.username'))                
                ->bcc($this->email_list);
    }
}
