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
    /**
     * Display a listing of votes.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewAny', Vote::class);
        $votes = Vote::where('creator_user_id', auth()->user()->id)->get();
        return SimpleVoteResource::collection($votes);
    }
    
    /**
     * Store a newly created vote in storage.
     *
     * @param  \App\Http\Requests\StoreVoteRequest  $request
     * @param  string  $votableType
     * @param  int $votableId
     * @return \App\Http\Resources\SimpleVoteResource
     */
    public function store(StoreVoteRequest $request, string $votableType, int $votableId)
    {
        $this->authorize('create', Vote::class);
        $data = $request->validated();

        $data['creator_user_id'] = $request->user()->id;
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
                abort(404, __('messages.votable_type_not_found'));
                break;
        }
        $data['votable_id'] = $votableId;

        // check if vote for votable already exists
        $existingVote = Vote::where('creator_user_id', $data['creator_user_id'])
            ->where('votable_id', $data['votable_id'])
            ->where('votable_type', $data['votable_type'])
            ->where('reciever_user_id', $data['reciever_user_id'])
            ->first();;

        // if vote exists, update it
        if($existingVote){
            $existingVote->update($data);
            return new SimpleVoteResource($existingVote);
        }else{
            // vote doesn't exist, create one
            $newVote = Vote::create($data);
            return new SimpleVoteResource($newVote);
        }
    }


    /**
     * Update the specified vote in storage.
     *
     * @param  \App\Http\Requests\UpdateVoteRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\SimpleVoteResource
     */
    public function update(UpdateVoteRequest $request, $id)
    {
        $vote = Vote::findOrFail($id);
        $this->authorize('update', $vote);
        $data = $request->validated();
        if($vote->update($data)){
            return new SimpleVoteResource($vote);
        }
        abort(500, __('messages.error_updating'));
    }

    /**
     * Remove the specified vote from storage by vote id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $vote = Vote::findOrFail($id);
        $this->authorize('delete', $vote);
        if($vote->delete()){
            return response()->json([
                'message' => __('messages.successful_deletion'),
            ], 200);
        }
        abort(500, __('messages.error_deleting'));
    }

    /**
     * Remove the specified vote from storage by votable id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyByVotableId(Request $request, $votableType, $votableId)
    {
        $votes = Vote::where('votable_id', $votableId);

        if($votes->count() > 0){
            switch ($votableType) {
                case 'contents':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Content');
                    break;
                case 'questions':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Question');
                    break;
                case 'comments':
                    $vote = $votes
                        ->where('votable_type', 'App\Models\Comment');
                    break;
                default:
                    abort(404, __('messages.votable_type_not_found'));
                    break;
            }
        }else{
            abort(404, __('messages.not_found'));
        }

        $votes = $votes->where('creator_user_id', $request->user()->id);
        if($votes->count() == 0){
            abort(403, __('messages.user_not_permitted_for_action'));
        }

        $vote = $votes->first();

        $this->authorize('delete', $vote);
        if($vote->delete()){
            return response()->json([
                'message' => __('messages.successful_deletion'),
            ], 200);
        }
        abort(500,_('messages.error_deleting'));
    }
}
