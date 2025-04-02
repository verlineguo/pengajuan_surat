<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKMA extends Model
{
    use HasFactory;

    protected $table = 'skma';

    protected $fillable = [
        'pengajuan_id',
        'semester',
        'alamat_bandung',
        'keperluan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id_pengajuan');
    }
}
