<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suara extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'calon_id',
    ];

    public function mahasiswas()
    {
        return $this->hasOne('App\Models\Mahasiswa');
    }

    public function calons()
    {
        return $this->hasOne('App\Models\Calon');
    }
}
