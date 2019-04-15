<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description', 
        'gallery_id', 
        'user_id'
    ];
}
