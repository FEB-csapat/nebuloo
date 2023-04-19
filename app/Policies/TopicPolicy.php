<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;
class TopicPolicy
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
        return Response::allow();
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Topic $topic): Response
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
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Topic $topic)
    {
        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        return Response::deny('Only moderator or admin can update topic');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Topic $topic)
    {
        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        return Response::deny('Only moderator or admin can delete topic');
    }
}
