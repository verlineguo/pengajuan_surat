<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Pengajuan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LetterUploaded extends Notification
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
            ->subject('Pengajuan Surat Berhasil')
            ->line('Pengajuan surat sudah bisa didownload.')
            ->line('Nama: ' . $mahasiswa->name)
            ->line('NRP: ' . $mahasiswa->nomor_induk)
            ->line('Jenis Surat: ' . $surat->nama_jenis_surat)
            ->line('File Surat: ' . $this->pengajuan->file_surat)
            ->action('Lihat Pengajuan', url('/mahasiswa/pengajuan/' . $this->pengajuan->id_pengajuan));
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
            'title' => 'Upload surat',
            'message' => 'Surat ' . $surat->nama_jenis_surat . ' sudah bisa didownload ',
            'action_url' => '/mahasiswa/pengajuan/show/' . $this->pengajuan->id_pengajuan,
            'created_at' => now(),
        ];
    }
}
