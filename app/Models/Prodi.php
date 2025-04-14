<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    // use HasFactory;

    protected $table = 'prodi';
    protected $primaryKey = 'kode_prodi';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $fillable = ['nama_prodi', 'kode_prodi'];


    public function users()
    {
        return $this->hasMany(User::class, 'kode_prodi', 'kode_prodi');
    }
    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'kode_prodi', 'kode_prodi');
    }

    

}
