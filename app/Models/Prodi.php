<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
    ];

    public function calons()
    {
        return $this->hasMany('App\Models\Calon');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
