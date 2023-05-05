<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;
class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any subjects.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view any subject.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Subject $subject): Response
    {
        return Response::allow();
    }
    
    /**
     * Determine whether the user can create subject.
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
     * Determine whether the user can update the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Subject $subject)
    {
        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }
        return Response::deny(__('messages.only_moderator_and_admin_has_access'));
    }

    /**
     * Determine whether the user can delete the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Subject $subject)
    {
        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }
        return Response::deny(__('messages.only_moderator_and_admin_has_access'));
    }
}
