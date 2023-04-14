<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Resources\ContentResource;
use App\Http\Resources\ImageResource;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Content::class, auth()->user());
        $contents = Content::all();
        return ContentResource::collection($contents);
    }

    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {
        $request->validated();

        $path = $request->file('image')->store('public/images');


        $image = new Image();
        $image->path = $path;
        $image->creator_user_id = auth()->user()->id;
        $image->save();

        return new ImageResource($image);

        return response()->json(['id' => $image->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $image = Image::findOrFail($id);

/*
        $path = Storage::url($image->path);

        // Return the image as a response
        return response()->file(storage_path('app' . $path));

            */

     //   return new ImageResource($image);


      //  return response()->json($image);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $path = $image->path;

        return response()->file(Storage::path($path));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $this->authorize('delete', $content, Content::class);
        
        $content->delete();
    }
}
