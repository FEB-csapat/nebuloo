<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Topic::class);
        $topics = Topic::all();
        return TopicResource::collection($topics);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBySubjectId(Request $request, int $id)
    {
        $this->authorize('viewAny', Topic::class);
        $topics = Topic::where('subject_id', $id)->get();
        return TopicResource::collection($topics);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $this->authorize('view', $topic);

        return new TopicResource($topic);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreTopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request)
    {
        $this->authorize('create', Topic::class);
        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;
        
        $newTopic = Topic::create($data);
        return new TopicResource($newTopic);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, int $id)
    {
        $topic = Topic::findOrFail($id);

        $this->authorize('update', $topic);

        $data = $request->validated();
        
        if($topic->update($data)){
            return new TopicResource($topic);
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
        $topic = Topic::findOrFail($id);

        $this->authorize('delete', $topic);
        
        $topic->delete();
    }
}
