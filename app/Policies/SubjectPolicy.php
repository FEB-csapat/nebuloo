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
        if($user?->banned==true){
            return Response::deny();
        }

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
        if($user?->banned==true){
            return Response::deny();
        }

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
        if($user?->banned==true){
            return Response::deny();
        }

        // visitors cannot create votes
        if ($user === null) {
            return Response::deny("Only logged in user...");
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
        if($user?->banned==true){
            return Response::deny();
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        return Response::deny('Only moderator or admin can update subject');
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
        if($user?->banned==true){
            return Response::deny();
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        return Response::deny('Only moderator or admin can delete subject');
    }
}
