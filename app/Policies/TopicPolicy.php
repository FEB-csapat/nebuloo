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
     * Determine whether the user can view any topic.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view any topic.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user): Response
    {
        return Response::allow();
    }
    
    /**
     * Determine whether the user can create topic.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        // visitors cannot create votes
        if ($user === null) {
            return Response::deny(__('messages.guests_are_not_permitted_for_this_action'));
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the topic.
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

        return Response::deny(__('messages.only_moderator_and_admin_has_access'));
    }

    /**
     * Determine whether the user can delete the topic.
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
        return Response::deny(__('messages.only_moderator_and_admin_has_access'));
    }
}
