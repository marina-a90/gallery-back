<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Gallery;
use App\Image;

class GalleriesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Gallery::getFilteredGalleries($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = Gallery::makeGallery($request);
        Image::makeImages($request->images, $gallery->id);
        return $gallery;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $gallery = Gallery::with('images', 'comments', 'user')->findOrFail($id);
        // return $gallery;

        return Gallery::getSingleGallery($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = auth()->user()->id;
        $gallery->save(); 

        $gallery->images()->delete();
        $images = [];
        Image::makeImages($request->images, $gallery->id);
        // $gallery->images()->saveMany($images);
        return $gallery;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Gallery::destroy($id);
    }
}
