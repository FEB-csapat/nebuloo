<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

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
        if($userRequester->banned==true){
            return Response::deny();
        }

        return Response::allow();
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
        if($userRequester->banned==true){
            return Response::deny();
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMe(?User $user)
    {
        if($user?->banned==true){
            return Response::deny();
        }

        if($user === null){
            return Response::deny('Log in to view information.');
        }
        return Response::allow();
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
        if($userRequester->banned==true){
            return Response::deny();
        }

        if($userRequester->id == $userRequested->id){
            return Response::allow();
        }
        // only admin can update users
        return $userRequester->hasAnyRole(['admin', 'moderator']);
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
        if($userRequester->banned==true){
            return Response::deny();
        }
        // admin can delete anybody, except themself
        if($userRequester->hasAnyRole(['admin'])
        && $userRequester->id != $userRequested->id){
            return Response::allow();
        }
        // 
        if($userRequester->id == $userRequested->id){
            return Response::allow();
        }

        return Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function ban(User $userRequester, User $userRequested)
    {
        if($userRequester->banned==true){
            return Response::deny();
        }
        // Only admin and moderator can ban
        if($userRequester->hasAnyRole(['admin', 'moderator'])){
            // Admin cannot be banned
            if($userRequested->hasAnyRole('admin')){
                Response::deny('Admin cannot be banned.');
            }
            return Response::allow();
        }
        return Response::deny('User is not permitted for this action.');
    }

    public function unban(User $userRequester, User $userRequested)
    {
        if($userRequester->banned==true){
            return Response::deny();
        }
        // Only admin and moderator can unban
        if($userRequester->hasAnyRole(['admin', 'moderator'])){

            return Response::allow();
        }
        return Response::deny('User is not permitted for this action.');
    }
}
