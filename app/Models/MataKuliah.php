<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    
    protected $primaryKey = 'kode_mk';

    protected $fillable = ['kode_mk', 'nama_mk', 'kode_prodi'];
    public $incrementing = false; 

    public $timestamps = true;


    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode_prodi');
    }
}
