<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirationVote extends Model
{
    protected $fillable = ['aspiration_id', 'mahasiswa_id'];

    public function aspiration() {
        return $this->belongsTo(Aspiration::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}
