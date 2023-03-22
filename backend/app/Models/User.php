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



    static function fromGoogle(GoogleUser $googleUser) : User {
        
        $newUser = new User;
        $newUser->google_id = $googleUser->id;
        $newUser->name = $googleUser->name;
        $newUser->email = $googleUser->email;
        
        $newUser->avatar = $googleUser->avatar;
        $newUser->avatar_original = $googleUser->avatar_original;
        
        return $newUser;
    }
    
    public function provider()
    {
        return $this->hasOne(Provider::class, 'user_id', 'id');
    }


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
