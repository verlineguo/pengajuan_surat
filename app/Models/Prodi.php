<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    // use HasFactory;

    protected $table = 'prodi';
    protected $fillable = ['nama_prodi', 'kode_prodi', 'kaprodi_id', 'tu_id'];

    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'kaprodi_id', 'nomor_induk');
    }

    public function tu()
    {
        return $this->belongsTo(User::class, 'tu_id', 'nomor_induk');
    }
}
