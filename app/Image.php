<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imageURL', 
        'gallery_id'
    ];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }
    
}
