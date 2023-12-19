<?php

namespace App\Models;

use App\Models\Jurusan;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


class Mahasiswa extends Model
{
    use HasFactory, Searchable;
    
    protected $fillable = ['nip', 'nama', 'email', 'nohp', 'alamat', 'id_jurusan', 'status'];

public function jurusan()
{
    return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id')->searchable();
}

public function toSearchableArray()
{
    return [
        'nip' =>  $this->nip,
        'nama' =>  $this->nama,
        'email' =>  $this->email,
        'nohp' =>  $this->nohp,
        'alamat' =>  $this->alamat,
        'id_jurusan' =>  $this->id_jrurusan,
        'status' =>  $this->status,
    ];
}
}