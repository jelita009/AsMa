<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'title', 
        'content', 
        'votes', 
        'user_id', 
        'category', 
        'reply', 
        'replied_by_admin_id', 
        'is_anonymous'
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function votesRelation() {
        return $this->hasMany(AspirationVote::class);
    }

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'user_id');
    }

    public function reports() {
        return $this->hasMany(AspirationReport::class);
    }
}
