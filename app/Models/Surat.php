<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Surat extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'surat';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jenis_surat'];
    public $timestamps = true;
}
