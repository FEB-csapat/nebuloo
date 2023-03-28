<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $this->authorize('viewAny', Comment::class);
        
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Comment::class);
        
        $comments = Comment::where('creator_user_id', $request->user()->id)->get();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, $commentableType, $commentableId)
    {
        $this->authorize('create', Comment::class);

        $data = $request->validated();
        $data['creator_user_id'] = $request->user()->id;

        if($commentableType == 'contents'){
            $data['commentable_type'] = 'App\Models\Content';
        }else if($commentableType == 'questions'){
            $data['commentable_type'] = 'App\Models\Question';
        }else{
            abort(500, 'Commentable type not found');
        }

        $data['commentable_id'] = $commentableId;

        $newComment = Comment::create($data);
        return new CommentResource($newComment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        
        $this->authorize('view', $comment, Comment::class);

        return new CommentResource($comment);
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

        $comment = Comment::findOrFail($id);

        $this->authorize('update', $comment, Comment::class);

        $data = $request->validated();
        
        if($comment->update($data)){
            return new CommentResource($comment);
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
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment, Comment::class);

        $comment->delete();
    }

}
