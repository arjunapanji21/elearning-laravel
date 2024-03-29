<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function soal()
    {
        return $this->hasMany(UjianSoal::class);
    }
    public function siswa()
    {
        return $this->hasMany(UjianSiswa::class);
    }
}
