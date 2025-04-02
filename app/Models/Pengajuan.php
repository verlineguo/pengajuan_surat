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
        'id_surat',
        'nrp',
        'tanggal_pengajuan',
        'status_pengajuan',
        'tanggal_persetujuan',
        'catatan_kaprodi',
        'catatan_tu',
        'file_surat',
    ];


    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'nrp', 'nomor_induk');
    }

    // Relasi ke tabel users (Kaprodi)


    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat', 'id');
    }

    public function sptmk()
    {
        return $this->hasOne(SPTMK::class, 'pengajuan_id');
    }

    public function skma()
    {
        return $this->hasOne(SKMA::class, 'pengajuan_id');
    }

    public function lhs()
    {
        return $this->hasOne(LHS::class, 'pengajuan_id');
    }

    public function skl()
    {
        return $this->hasOne(SKL::class, 'pengajuan_id', 'id_pengajuan');
    }


}
