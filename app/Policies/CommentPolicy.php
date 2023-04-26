<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any comment.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view any comment.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMe(?User $user)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        if ($user === null) {
            return Response::deny('User must be logged in to view their comments.');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Comment $comment)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create comment.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        // visitors cannot create comments
        if ($user === null) {
            return Response::deny('User must be logged in to create comments.');
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Comment $comment)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        // visitors cannot update comments
        if ($user === null) {
            return Response::deny('User must be logged in to update comments.');
        }
        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }
        if($user->id != $comment->creator_user_id){
            return Response::deny('User can only edit their comments');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Comment $comment)
    {
        if($user?->banned==true){
            return Response::deny();
        }
        
        // visitors cannot delete comments
        if ($user === null) {
            return Response::deny('User must be logged in to update comments.');
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        if($user->id != $comment->creator_user_id){
            return Response::deny('User can only edit their comments');
        }

        return Response::allow();
    }
}
