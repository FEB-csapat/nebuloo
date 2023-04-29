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
     * Store a newly created image in storage.
     *
     * @param  \App\Http\Requests\StoreImageRequest  $request
     * @return \App\Http\Resources\ImageResource
     */
    public function store(StoreImageRequest $request)
    {
        $this->authorize('create', Image::class);
        $request->validated();
        $path = $request->file('image')->store('public/images');
        $image = new Image();
        $image->path = $path;
        $image->creator_user_id = auth()->user()->id;
        $image->save();
        return new ImageResource($image);
    }

    /**
     * Display the specified image.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        if (!$image) {
            abort(404, __('messages.not_found'));
        }
        $path = $image->path;
        return response()->file(Storage::path($path));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('delete', $content);
        if($content->delete()){
            return response()->json([
                'message' => __('messages.successful_deletion'),
            ], 200);
        }
        abort(500, __('messages.error_deleting'));
        
    }
}
