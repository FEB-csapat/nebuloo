<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     *
     * @param  \App\Models\User  $userRequester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $userRequester)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $userRequester, User $userRequested)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $userRequester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMe(?User $user)
    {
        if ($user === null) {
            return Response::deny(__('messages.guests_are_not_permitted_for_this_action'));
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can create user.
     *
     * @param  \App\Models\User  $userRequester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $userRequester)
    {
        // Only admin can create users
        return $userRequester->isAdmin();
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $userRequester, User $userRequested)
    {
        // User update themself
        if($userRequester->id == $userRequested->id){
            return Response::allow();
        }
        // Only admin and moderator can update other users

        if($userRequester->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can update the user's role.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateRole(?User $userRequester, User $userRequested)
    {
        // Only admin can update role of moderators and users
        if($userRequester->isAdmin()){
            // Admin's role cannot be updated
            if($userRequested->isAdmin()){
                return Response::deny(__('messages.admins_role_cannot_be_updated'));
            }
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $userRequester, User $userRequested)
    {
        // Admin can delete anybody, except admins
        if($userRequester->isAdmin()){
            if($userRequested->isAdmin()){
                return Response::deny('Admin cannot be deleted!');
            }
            return Response::allow();
        }

        // user can delete themself
        if($userRequester->id == $userRequested->id){
            return Response::allow();
        }

        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can ban other user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function ban(?User $userRequester, User $userRequested /*?User $user, User $userRequested */)
    {
        // Admin can ban moderators and users
        if($userRequester->isAdmin()){
            // Admin cannot ban admins
            if($userRequested->isAdmin()){
                return Response::deny(__('messages.admin_cannot_be_banned'));
            }
            return Response::allow();
        }

        // Moderator can ban only users
        if($userRequester->isModerator()){
            // Moderator cannot ban admins
            if($userRequested->isAdmin()){
                return Response::deny(__('messages.admin_cannot_be_banned'));
            }
            // Moderator cannot ban moderators
            if($userRequested->isModerator()){
                return Response::deny(__('messages.moderator_cannot_be_banned_as_moderator'));
            }
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can unban other user.
     *
     * @param  \App\Models\User  $userRequester
     * @param  \App\Models\User  $userRequested
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function unban(User $userRequester, User $userRequested)
    {
        // Only admin and moderator can unban
        if($userRequester->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }
}
