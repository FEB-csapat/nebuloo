<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $this->authorize('viewAny', Content::class, auth()->user());
        $contents = Content::all();
        return ContentResource::collection($contents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Content::class, auth()->user());

        $contents = Content::where('creator_user_id', $request->user()->id)->get();
        return ContentResource::collection($contents);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentRequest $request)
    {
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
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

        $this->authorize('view', [$content], Content::class);
        
        return new ContentResource($content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentRequest $request, $id)
    {
        $content = Content::findOrFail($id);

        $this->authorize('update', $content, Content::class);

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

        $this->authorize('delete', $content, Content::class);
        
        $content->delete();
    }
}
