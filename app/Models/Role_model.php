<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_model extends Model
{
    use HasFactory;

    protected $table ='model_has_roles';
    protected $primaryKey = 'model_id';
    public $timestamps = false;
}
