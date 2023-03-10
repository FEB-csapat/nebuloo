<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$this->authorize('viewAny', Comment::class)){
            abort(403);
        }
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->authorize('create', Comment::class)){
            abort(403);
        }

        $data = $request->validated();
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
        
        if(!$this->authorize('view', $comment, Comment::class)){
            abort(403);
        }

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

        if(!$this->authorize('update', $comment, Comment::class)){
            abort(403);
        }

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

        if(!$this->authorize('delete', $comment, Comment::class)){
            abort(403);
        }

        $comment->delete();
    }

}
