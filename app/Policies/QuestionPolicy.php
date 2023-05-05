<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any questions.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the question.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Question $question): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view their questions.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMe(?User $user): Response
    {
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        return Response::allow();
    }


    /**
     * Determine whether the user can create question.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user): Response
    {
        // visitors cannot create question
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Question $question): Response
    {
        // visitors cannot update question
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        if($user->id == $question->creator_user_id){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(?User $user, Question $question): Response
    {
        // visitors cannot delete question
        if ($user === null) {
            return Response::deny(__('messages.guest_not_permitted_for_action'));
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        // return true if the user is the creator of the question
        if($user->id == $question->creator_user_id){
            return Response::allow();
        }
        return Response::deny(__('messages.user_not_permitted_for_action'));
    }
}
