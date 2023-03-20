<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Http\Resources\VoteResource;
use App\Models\Content;
use App\Models\Vote;
use App\Models\Question;
use App\Models\Comment;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    protected $model = Vote::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Vote::class, auth()->user());
        $votes = Vote::where('owner_user_id', auth()->user()->id)->get();
        return VoteResource::collection($votes);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request)
    {
        $data = $request->validated();
        $data['owner_user_id'] = $request->user()->id;
        switch ($data['votable_type']) {
            case 'content':
                $data['granted_user_id'] = Content::find($data['votable_id'])
                    ->creator_user_id;
                break;
            case 'question':
                $data['granted_user_id'] = Question::find($data['votable_id'])
                    ->creator_user_id;
                break;
            case 'comment':
                $data['granted_user_id'] = Comment::find($data['votable_id'])
                    ->creator_user_id;
                break;
            
            default:
                // some sort of error happened
                break;
        }
        
        $newVote = Vote::create($data);
        
        return new VoteResource($newVote);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteRequest $request, $id)
    {
        $vote = Vote::findOrFail($id);

        $this->authorize('update', $vote, Vote::class);

        $data = $request->validated();
        
        if($vote->update($data)){
            return new VoteResource($vote);
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
        $vote = Vote::findOrFail($id);

        $this->authorize('delete', $vote, Vote::class);
        
        $vote->delete();
    }
}
