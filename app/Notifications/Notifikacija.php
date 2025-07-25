<?php

namespace App\Notifications;

use App\Models\Aktivnost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifikacija extends Notification
{
    use Queueable;

    protected $aktivnost;
    /**
     * Create a new notification instance.
     */
    public function __construct(Aktivnost $aktivnost)
    {
        $this->aktivnost = $aktivnost;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        return [
            'naziv' => $this->aktivnost->naziv,
            'opis' => $this->aktivnost->opis,
            'tip' => $this->aktivnost->tip,
            'pocetak' => $this->aktivnost->pocetak,
            'kraj' => $this->aktivnost->kraj,
            'status' => $this->aktivnost->status,
            'drustvo_id' => $this->aktivnost->drustvo_id,
            'user_id' => $this->aktivnost->user_id,
            'poruka' => 'Podsetnik: aktivnost "' . $this->aktivnost->naziv . '" počinje uskoro.',
        ];
    }
}
