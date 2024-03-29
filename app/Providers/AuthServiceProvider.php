<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use App\Models\Vote;
use App\Models\User;
use App\Models\Ticket;
use App\Policies\ContentPolicy;
use App\Policies\CommentPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\VotePolicy;
use App\Policies\UserPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Content::class => ContentPolicy::class,
        Question::class => QuestionPolicy::class,
        Comment::class => CommentPolicy::class,
        Vote::class => VotePolicy::class,
        User::class => UserPolicy::class,
        Ticket::class => TicketPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
