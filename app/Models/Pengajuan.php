<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengajuan extends Model
{
    use HasFactory, Notifiable;

    protected $table = "pengajuan";

    protected $primaryKey = 'id_pengajuan'; 

    public $incrementing = true;

    protected $fillable = [
        'id_document',
        'nrp',
        'nik_kaprodi',
        'tanggal_pengajuan',
        'status_pengajuan',
        'tanggal_persetujuan',
        'catatan_kaprodi',
        'catatan_tu',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'nrp', 'nomor_induk');
    }

    // Relasi ke tabel users (Kaprodi)
    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'nik_kaprodi', 'nomor_induk');
    }

    public function detailSurat()
    {
        return $this->belongsTo(DetailSurat::class, 'id_document', 'id');
    }
    

}
