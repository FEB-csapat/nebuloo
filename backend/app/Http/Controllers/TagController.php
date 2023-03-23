<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;
use Spatie\Tags\Tag;
use App\Models\User;
use App\Http\Resources\TagResource;

// TODO add authorization
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');

        $tags = Tag::query();

        if ($type != null) {
            $tags = $tags->where('type', $type);
        }

        return TagResource::collection($tags->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return new TagResource($tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
       // $this->authorize('create', User::class);
        $data = $request->validated();
        // TODO fix duplication of tags with same name but different type
        $alreadyExists = Tag::where('name', $data['name'])->first();
        dd($alreadyExists);
        if($alreadyExists){
            return new TagResource($alreadyExists);
        }else{
            $newTag = Tag::findOrCreate($data['name'], 'user-created');
        }

        
        return new TagResource($newTag);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
