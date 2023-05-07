<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of comments.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Comment::class);
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    /**
     * Display a listing of the comment created by the user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function meIndex(Request $request)
    {
        $this->authorize('viewMe', Comment::class);
        $comments = Comment::where('creator_user_id', $request->user()->id)->get();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \App\Http\Resources\CommentResource
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
            abort(404, __('messages.commentable_type_not_found'));
        }

        $data['commentable_id'] = $commentableId;

        $newComment = Comment::create($data);
        return new CommentResource($newComment);
    }

    /**
     * Display the specified comment.
     *
     * @param  int  $id
     * @return \App\Http\Resources\CommentResource
     */
    public function show(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        
        $this->authorize('view', $comment);

        return new CommentResource($comment);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\CommentResource
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('update', $comment);

        $data = $request->validated();
        
        if($comment->update($data)){
            return new CommentResource($comment);
        }
        abort(500, __('messages.error_updating'));
    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment);

        $comment->delete();
        return response()->json([
            'message' => __('messages.successful_deletion'),
        ], 200);
    }

}
