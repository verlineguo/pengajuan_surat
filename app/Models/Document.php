<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Document extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'document';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama_dokumen'];
    public $timestamps = true;
}
