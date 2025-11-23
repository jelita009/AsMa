<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $fillable = ['nim', 'password'];

    public function aspirationVotes() {
        return $this->hasMany(\App\Models\AspirationVote::class, 'mahasiswa_id');
    }

    public function reports() {
        return $this->hasMany(AspirationReport::class, 'mahasiswa_id');
    }
}
