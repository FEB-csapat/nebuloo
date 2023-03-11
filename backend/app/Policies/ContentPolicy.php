<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Content $content)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        // visitors cannot create content
        if ($user === null) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Content $content)
    {
        // visitors cannot update content
        if ($user === null) {
            return false;
        }

        // return true if the user is the creator of the content
        return $user->id == $content->creator_user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Content $content)
    {
        // visitors cannot delete content
        if ($user === null) {
            return false;
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return true;
        }

        // return true if the user is the creator of the content
        return $user->id == $content->creator_user_id;
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
