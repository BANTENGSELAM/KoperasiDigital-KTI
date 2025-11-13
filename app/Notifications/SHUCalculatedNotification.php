<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SHUCalculatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $jumlah;
    protected $periode;

    public function __construct($jumlah, $periode)
    {
        $this->jumlah = $jumlah;
        $this->periode = $periode;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // kirim email dan simpan ke tabel notifikasi
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('SHU Koperasi Digital Periode ' . $this->periode)
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Koperasi Digital telah menghitung pembagian SHU periode ' . $this->periode . '.')
            ->line('Anda menerima SHU sebesar Rp ' . number_format($this->jumlah, 2))
            ->action('Lihat Detail', url('/dashboard'))
            ->line('Terima kasih telah berkontribusi dalam pengelolaan sampah berkelanjutan!');
    }

    public function toArray($notifiable)
    {
        return [
            'pesan' => 'Anda menerima SHU periode ' . $this->periode,
            'jumlah' => $this->jumlah,
        ];
    }
}
