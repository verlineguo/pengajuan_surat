<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKL extends Model
{
    protected $table = 'skl';

    protected $fillable = [
        'pengajuan_id',
        'tanggal_kelulusan',
    ];
    

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id_pengajuan');
    }
}
