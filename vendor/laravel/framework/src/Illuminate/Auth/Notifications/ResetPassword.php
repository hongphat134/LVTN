<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Xin chào quý khách!')
            ->line('Quý khách nhận được email này vì chúng tôi nhận được yêu cầu khôi phục mật khẩu từ tài khoản của quý khách.')
            ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)),)
            ->line('Nếu quý khách không yêu cầu khôi phục mật khẩu, hãy bỏ qua tin nhắn này.')
            ->salutation('Trân trọng gửi đến quý khách, HTP');
    }
}
