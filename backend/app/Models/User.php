<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

use Laravel\Socialite\Contracts\User as GoogleUser;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $hidden = [
        'remember_token',
    ];

    protected $fillable = [
        'email', 'email_verified_at', 'name', 'bio',
    ];

    
    public function provider()
    {
        return $this->hasOne(Provider::class, 'user_id', 'id');
    }


    public function rank()
    {
        return $this->hasOne(Rank::class, 'id', 'rank_id');
    }

    public function ownedVotes()
    {
        return $this->hasMany(Vote::class, 'owner_user_id');
    }

    public function recievedVotes()
    {
        return $this->hasMany(Vote::class, 'reciever_user_id');
    }


    public function contents()
    {
        return $this->hasMany(Content::class, 'creator_user_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'creator_user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id', 'comment_id');
    }
}
