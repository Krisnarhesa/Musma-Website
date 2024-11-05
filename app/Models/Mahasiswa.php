<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'verified_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function suaras()
    {
        return $this->hasMany('App\Models\Suara');
    }
    public function getTakeImageAttribute()
    {
        return "/storage/". $this->file_url;
    }
}
