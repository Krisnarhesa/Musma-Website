<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prodi_id',
        'nama_panggilan',
        'visi',
        'misi',
        'jenis_calon',
        'photo_url',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi');
    }

    public function suaras()
    {
        return $this->hasMany('App\Models\Suara');
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->photo_url;
    }
}
