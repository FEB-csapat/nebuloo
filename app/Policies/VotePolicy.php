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
     * Determine whether the user can view any votes.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        return Response::allow();
    }

    
    /**
     * Determine whether the user can create vote.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        // visitors cannot create votes
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the vote.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Vote $vote)
    {
        // visitors cannot update vote
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        if($user->id == $vote->creator_user_id){
            return Response::allow();
        }

        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can delete the vote.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Vote $vote)
    {
        // visitors cannot delete votes
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        // Only creator can delete votes
        if($user->id == $vote->creator_user_id){
            return Response::allow();
        }

        return Response::deny(__('messages.user_not_permitted_for_action'));
    }
}
