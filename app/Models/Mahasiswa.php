<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $fillable = ['nim', 'password'];
}
