<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPTMK extends Model
{
    use HasFactory;

    protected $table = 'sptmk';

    protected $fillable = [
        'pengajuan_id',
        'tujukan',
        'mata_kuliah',
        'semester',
        'data_mahasiswa',
        'tujuan',
        'topik',
    ];
    

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id_pengajuan');
    }
}