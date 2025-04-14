<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Pengajuan;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanApproved extends Notification
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

    public function toMail(object $notifiable): MailMessage
    {
        $surat = $this->pengajuan->surat;
        $mahasiswa = $this->pengajuan->mahasiswa;

        return (new MailMessage)
            ->subject('Pengajuan Surat Baru')
            ->line('pengajuan surat baru dari mahasiswa sudah diapprove kaprodi .')
            ->line('Nama: ' . $mahasiswa->name)
            ->line('NRP: ' . $mahasiswa->nomor_induk)
            ->line('Jenis Surat: ' . $surat->nama_jenis_surat)
            ->line('Tanggal Persetujuan: ' . $this->pengajuan->tanggal_persetujuan)
            ->line('Sekarang akan diteruskan ke TU .');
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
            'title' => 'Pengajuan Surat di approve',
            'message' => 'Pengajuan surat ' . $surat->nama_jenis_surat . ' dari ' . $mahasiswa->name . ' dengan NRP ' . $mahasiswa->nomor_induk . ' sudah di approved kaprodi',
            'action_url' => '/tu/pengajuan/' . $this->pengajuan->id_pengajuan,
            'created_at' => now(),
        ];
    }
}
