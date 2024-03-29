<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
}
