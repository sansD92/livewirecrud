<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $fillable = ['nip', 'nama', 'email', 'nohp', 'alamat', 'id_jurusan', 'status'];

public function jurusan()
{
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
}
}