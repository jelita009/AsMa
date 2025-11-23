<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirationReport extends Model
{
    protected $fillable = ['aspiration_id', 'mahasiswa_id', 'reason'];

    public function aspiration() {
        return $this->belongsTo(Aspiration::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
