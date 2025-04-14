<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanSubmitted extends Notification
{
    use Queueable;
    protected $pengajuan;


    /**
     * Create a new notification instance.
     */
    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }




    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $surat = $this->pengajuan->surat;
        $mahasiswa = $this->pengajuan->mahasiswa;

        return (new MailMessage)
            ->subject('Pengajuan Surat Baru')
            ->line('Ada pengajuan surat baru dari mahasiswa.')
            ->line('Nama: ' . $mahasiswa->name)
            ->line('NRP: ' . $mahasiswa->nomor_induk)
            ->line('Jenis Surat: ' . $surat->nama_jenis_surat)
            ->line('Tanggal Pengajuan: ' . $this->pengajuan->tanggal_pengajuan)
            ->action('Lihat Pengajuan', url('/kaprodi/pengajuan/' . $this->pengajuan->id_pengajuan));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        $surat = $this->pengajuan->surat;
        $mahasiswa = $this->pengajuan->mahasiswa;
        
        return [
            'id_pengajuan' => $this->pengajuan->id_pengajuan,
            'title' => 'Pengajuan Surat Baru',
            'message' => 'Pengajuan surat ' . $surat->nama_jenis_surat . ' dari ' . $mahasiswa->name . ' (' . $mahasiswa->nomor_induk . ')',
            'action_url' => '/kaprodi/pengajuan/' . $this->pengajuan->id_pengajuan,
            'created_at' => now(),
        ];
    }
}
