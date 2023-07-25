<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}
