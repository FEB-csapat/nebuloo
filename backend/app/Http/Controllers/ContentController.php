<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;



class ContentController extends Controller
{

    protected $model = Content::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$this->authorize('viewAny', Content::class)){
            abort(403);
        }
        $contents = Content::all();
        return ContentResource::collection($contents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->authorize('create', Content::class)){
            abort(403);
        }
        $data = $request->validated();
        $newContent = Content::create($data);
        return new ContentResource($newContent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if($this->authorize('view', [$content], Content::class)){
            abort(403);
        }
        
        return new ContentResource($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $content = Content::findOrFail($id);

        if(!$this->authorize('update', $content, Content::class)){
            abort(403);
        }

        $data = $request->validated();
        
        if($content->update($data)){
            return new ContentResource($content);
        }
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

        if(!$this->authorize('delete', $content, Content::class)){
            abort(403);
        }
        
        $content->delete();
    }
}
