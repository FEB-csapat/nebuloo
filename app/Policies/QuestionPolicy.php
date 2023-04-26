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
        if($user?->banned==true){
            return Response::deny();
        }

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
        if($user?->banned==true){
            return Response::deny();
        }

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
        if($user?->banned==true){
            return Response::deny();
        }

        if ($user === null) {
            return Response::deny('User must be logged in to create question.');
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
        if($user?->banned==true){
            return Response::deny();
        }

        // visitors cannot create question
        if ($user === null) {
            return Response::deny('User must be logged in to create question.');
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
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
        if($user?->banned==true){
            return Response::deny();
        }

        // visitors cannot update question
        if ($user === null) {
            return Response::deny('User must be logged in to edit question.');
        }

        if($user->hasAnyRole(['admin', 'moderator']) ){
            return Response::allow();
        }

        if($user->id == $question->creator_user_id){
            return Response::allow();
        }
        
        return Response::deny('User is not permitted for this action.');
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
        if($user?->banned==true){
            return Response::deny();
        }
        
        // visitors cannot delete question
        if ($user === null) {
            return Response::deny('User must be logged in to delete question.');
        }

        if($user->hasAnyRole(['admin', 'moderator'])){
            return Response::allow();
        }

        // return true if the user is the creator of the question
        if($user->id == $question->creator_user_id){
            return Response::allow();
        }
        return Response::deny('User is not permitted for this action');
    }
}
