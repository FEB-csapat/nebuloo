<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Comment $comment)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        // visitors cannot upload images
        if ($user === null) {
            return Response::deny(__('messages.guests_are_not_permitted_for_this_action'));
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
        // visitors cannot delete comments
        if ($user === null) {
            return Response::deny(__('messages.guests_are_not_permitted_for_this_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        if($user->id == $comment->creator_user_id){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }
}
