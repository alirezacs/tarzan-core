<?php

namespace App\Notifications;

use App\Notifications\channels\FarazSmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginCodeNotification extends Notification
{
    use Queueable;

    public int $code;

    public string $pattern = 'il9ssng6iaiii4h';

    public array $data = [];

    /**
     * Create a new notification instance.
     */
    public function __construct(int $code)
    {
        $this->code = $code;

        $this->data = [
            'code' => $this->code
        ];

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FarazSmsChannel::class];
    }

}
