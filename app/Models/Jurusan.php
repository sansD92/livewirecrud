<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_jurusan',
    ];
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
