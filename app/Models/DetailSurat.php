<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


    
class DetailSurat extends Model {
    use HasFactory;

    protected $table = 'detail_surat';
    protected $fillable = ['pengajuan_id', 'semester', 'alamat_bandung', 'tujukan', 'keperluan', 'tujuan', 'mata_kuliah', 'data_mahasiswa', 'topik', 'tanggal_kelulusan'];

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class);
    }
}
