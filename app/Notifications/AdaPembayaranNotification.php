<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AdaPembayaranNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $pembayaranPraktikum;
    public function __construct($pembayaranPraktikum)
    {
        //
        $this->pembayaranPraktikum = $pembayaranPraktikum;
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
            'jadwal_praktikum_id' => $this->pembayaranPraktikum->jadwal_praktikum_id,
            'namarek' => $this->pembayaranPraktikum->namarek,
            'norek' => $this->pembayaranPraktikum->norek,
            'harga' => $this->pembayaranPraktikum->harga,
            'pembayaran_praktikum_id' => $this->pembayaranPraktikum->id,
            'title' => 'Pemberitahuan Pembayaran',
            'message' => 'Silahkan Lakukan Pembayaran',
        ];
    }
}
