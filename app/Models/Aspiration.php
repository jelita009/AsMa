<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = ['title', 'content', 'votes', 'user_id', 'category'];
}
