<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(?User $user): Response
    {
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }
        return Response::deny('Felhasználónak nincs jogosultsága ehhez a művelethez!');
    }

    public function viewMe(?User $user): Response
    {
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        return Response::allow();
    }

    public function update(?User $user, Ticket $ticket): Response
    {
        // visitors cannot update question
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    public function delete(?User $user, Ticket $ticket): Response
    {
        // visitors cannot delete ticket
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        // return true if the user is the creator of the ticket
        if($user->id == $ticket->creator_user_id){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    public function create(?User $user): Response
    {
        //visitors cannot create ticket
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        return Response::allow();
    }
}
