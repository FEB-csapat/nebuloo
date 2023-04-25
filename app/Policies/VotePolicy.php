<?php

namespace App\Policies;

use App\Models\Vote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;
class VotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        if($user->banned==true){
            return Response::deny();
        }

        if($user === null){
            //TODO fix error messages...
            return Response::deny("Only logged in user...");
        }
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
        if($user->banned==true){
            return Response::deny();
        }
        // visitors cannot create votes
        if ($user === null) {
            return Response::deny("Only logged in user...");
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Vote $vote)
    {
        if($user->banned==true){
            return Response::deny();
        }
        
        // visitors cannot update vote
        if ($user === null) {
            return Response::deny("Only logged in user...");
        }
        if($user->id != $vote->owner_user_id){
            return Response::deny("Not yours");
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Vote $vote)
    {
        if($user->banned==true){
            return Response::deny();
        }

        // visitors cannot delete votes
        if ($user === null) {
            return Response::deny("Only logged in user...");
        }

        if($user->id != $vote->owner_user_id){
            return Response::deny("Not yours");
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vote $vote)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vote $vote)
    {
        //
    }
}
