<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PembayaranNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $checkout;
    public function __construct($checkout)
    {
        //
        $this->checkout = $checkout;
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
            'pembayaran_praktikum_id' => $this->checkout->pembayaran_praktikum_id,
            'user_id' => $this->checkout->user_id,
            'checkout_id' => $this->checkout->id,
            'title' => 'Pembayaran Praktikum',
            'message' => $this->checkout->user->nama . 'Melakukan Pembayaran',
        ];
    }
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'checkout_id' => $this->checkout->id,
    //         'user_id' => $this->checkout->user_id,
    //         'pembayaran_praktikum_id' => $this->checkout->pembayaran_praktikum_id,
    //         'photo' => $this->checkout->photo,
    //         'status' => $this->checkout->status,
    //         'title' => 'Pembayaran Praktikum',
    //         'message' => $this->checkout->user->nama . 'Melakukan Pembayaran',
    //     ];
    // }
}
