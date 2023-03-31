<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any contents.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the content.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Content $content): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view their contents.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMe(?User $user): Response
    {
        if ($user === null) {
            return Response::deny('User must be logged in to create content.');
        }
        return Response::allow();
    }


    /**
     * Determine whether the user can create content.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user, Content $content): Response
    {
        
        // visitors cannot create content
        if ($user === null) {
            return Response::deny('User must be logged in to create content.');
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        if($user->id == $content->creator_user_id){
            return Response::allow();
        }
        
        return Response::deny('User is not permitted for this action.');
    }

    /**
     * Determine whether the user can update the content.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Content $content): Response
    {
        // visitors cannot update content
        if ($user === null) {
            return Response::deny('User must be logged in to edit content.');
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        if($user->id == $content->creator_user_id){
            return Response::allow();
        }
        
        return Response::deny('User is not permitted for this action.');
    }

    /**
     * Determine whether the user can delete the content.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Content $content): Response
    {
        // visitors cannot delete content
        if ($user === null) {
            return Response::deny('User must be logged in to delete content.');
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        // return true if the user is the creator of the content
        if($user->id == $content->creator_user_id){
            return Response::allow();
        }
        return Response::deny('User is not permitted for this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(?User $user, Content $content)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(?User $user, Content $content)
    {
        //
    }
}
