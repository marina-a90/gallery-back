<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CommentRequest;

class Comment extends Model
{
    protected $fillable = [
        'description', 
        'gallery_id', 
        'user_id'
    ];

    public function gallery() {
        return $this->belongsTo(Gallery::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function makeComment(CommentRequest $request) {
        $comment = self::create([
            "description" => $request['description'],
            "gallery_id" => $request['gallery_id'],
            'user_id' => auth()->user()->id,
        ]);

        return $comment;
    }

}
