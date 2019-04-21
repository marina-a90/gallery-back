<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;

class Gallery extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'user_id'
    ];

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getFilteredGalleries(Request $request, $user_id=null) {
        $term = $request['term'];
        $query = self::query();
        $query->with('user', 'images');

        if($user_id) {
            $query->where('user_id', "=", $user_id);
        }

        if($term){
            $query->whereHas('user', function($query) use ($term) {
                $query->where('title', 'like', '%'.$term.'%')
                        ->orWhere('description', 'like', '%'.$term.'%')
                            ->orWhere('first_name', 'like', '%'.$term.'%')
                                ->orWhere('last_name', 'like', '%'.$term.'%');
        });
        }

        return response()->json([ 'galleries' =>  $query->latest()->paginate(10) ]);
    }

    public static function makeGallery(GalleryRequest $request) 
    {
        return self::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => $user = auth()->user()->id
        ]);
        
    }

    public static function getSingleGallery($id) {
        return Gallery::with('user', 'images', 'comments.user')->findOrFail($id);
    }


}
