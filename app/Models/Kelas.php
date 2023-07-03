<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guru()
    {
        return $this->belongsTo(Profile::class, 'profile_id')->where('role', 'Guru');
    }
    public function siswa()
    {
        return $this->hasMany(KelasSiswa::class);
    }
}
