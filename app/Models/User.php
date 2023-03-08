<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Tags\HasTags;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, HasApiTokens, HasRoles;//, Notifiable, HasApiTokens ;

    protected $table = 'users';
    protected $primaryKey = 'id';


    public function rank()
    {
        return $this->hasOne(Rank::class, 'id', 'rank_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'id', 'vote_id');
    }


    public function contents()
    {
        return $this->hasMany(Content::class, 'id', 'content_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'id', 'question_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id', 'comment_id');
    }
}
