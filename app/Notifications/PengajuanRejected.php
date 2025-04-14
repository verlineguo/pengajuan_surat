<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Pengajuan;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanRejected extends Notification
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
        ->line('pengajuan surat baru dari mahasiswa ditolak kaprodi .')
        ->line('Nama: ' . $mahasiswa->name)
        ->line('NRP: ' . $mahasiswa->nomor_induk)
        ->line('Jenis Surat: ' . $surat->nama_jenis_surat)
        ->line('Catatan Kaprodi : ' . $surat->catatan_kaprodi)        
        ->line('Tanggal Persetujuan: ' . $this->pengajuan->tanggal_persetujuan)
        ->line('pengajuan surat tidak akan diteruskan ke kaprodi. silakan upload ulang .')
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
            'title' => 'Pengajuan Surat di tolak',
            'message' => 'Pengajuan surat ' . $surat->nama_jenis_surat . ' dari ' . $mahasiswa->name . ' dengan NRP ' . $mahasiswa->nomor_induk . ' tidak diterima :(',
            'action_url' => '/tu/pengajuan/' . $this->pengajuan->id_pengajuan,
            'created_at' => now(),
        ];
    }
}
