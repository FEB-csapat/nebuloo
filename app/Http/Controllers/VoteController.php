<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Http\Resources\SimpleVoteResource;
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
        return SimpleVoteResource::collection($votes);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request, $votableType, $votableId)
    {
        $data = $request->validated();




















        
        $data['owner_user_id'] = $request->user()->id;
        switch ($votableType) {
            case 'contents':
                $data['votable_type'] = 'App\Models\Content';
                $data['reciever_user_id'] = Content::find($votableId)
                    ->creator_user_id;
                break;
            case 'questions':
                $data['votable_type'] = 'App\Models\Question';
                $data['reciever_user_id'] = Question::find($votableId)
                    ->creator_user_id;
                break;
            case 'comments':
                $data['votable_type'] = 'App\Models\Comment';
                $data['reciever_user_id'] = Comment::find($votableId)
                    ->creator_user_id;
                break;
            
            default:
                abort(500, 'Votable type not found');
                break;
        }
        $data['votable_id'] = $votableId;
        $data['votable_type'] = 'App\Models\Content';


        // TODO write test for this!
        // check if vote for votable already exists
        $existingVote = Vote::where('owner_user_id', $data['owner_user_id'])
            ->where('votable_id', $data['votable_id'])
            ->where('votable_type', $data['votable_type'])
            ->where('reciever_user_id', $data['reciever_user_id'])
            ->first();

        // if vote exists, update it
        if($existingVote){
            $existingVote->update($data);
            return new SimpleVoteResource($existingVote);
        }else{
            // vote doesn't exist, update it
            $newVote = Vote::create($data);
            return new SimpleVoteResource($newVote);
        }
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
            return new SimpleVoteResource($vote);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyByVotableId(Request $request, $votableType, $votableId)
    {
        $votes =
        Vote::where('votable_id', $votableId)
            ->where('owner_user_id', $request->user()->id);

        if($votes){
            switch ($votableType) {
                case 'contents':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Content')
                        ->first();
                    break;
                case 'questions':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Question')
                        ->first();
                    break;
                case 'comments':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Comment')
                        ->first();
                    break;
                default:
                    abort(500, 'Votable type not found');
                    break;
            }
        }else{
            // TODO write proper error message
            abort(404, 'Votable type not found');
        }

        $this->authorize('delete', $vote, Vote::class);
        
        $vote->delete();
    }
}
