<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LHS extends Model
{
    protected $table = 'lhs';

    protected $fillable = [
        'pengajuan_id',
        'keperluan',
    ];
    

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'id_pengajuan');
    }
}
