<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;

    
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, $id): Response
    {
        if($user?->banned==true){
            return Response::deny();
        }
        
        if($user->hasAnyRole(['admin'])
        && $user->id != $id){
            return Response::allow();
        }
        // only admin can update users  
        return Response::deny();

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, $id)
    {
        
    }
}
