<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $userRequester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $userRequester)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $userRequester, User $userRequested)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $userRequester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $userRequester)
    {
        // only admin can create users
        return $userRequester->hasAnyRole(['admin']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $userRequester, User $userRequested)
    {
        // only admin can update users
        return $userRequester->hasAnyRole(['admin']);

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $userRequester, User $userRequested)
    {
        if($userRequester->id == $userRequested->id){
            return true;
        }

        // only admin can update users
        return $userRequester->hasAnyRole(['admin']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $userRequester, User $userRequested)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $userRequester, User $userRequested)
    {
        //
    }
}
