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

    public static function makeImages($images, $id) {
        foreach($images as $imgage) {
            self::create([
                'imageURL' => $image,
                'gallery_id' => $id
            ]);
        }
        return;
    }
    
}
