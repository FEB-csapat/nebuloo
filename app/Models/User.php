<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $hidden = [
        'remember_token',
    ];

    protected $fillable = [
        'email', 'email_verified_at', 'name', 'bio', 'password'
    ];

    public function provider()
    {
        return $this->hasOne(Provider::class, 'user_id', 'id');
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
    public function tickets(){
        return $this->hasMany(Ticket::class,'creator_user_id');
    }

    public function sumVoteScore(){
        return $this->recievedVotes->where('direction', 'up')->count()
        - $this->recievedVotes->where('direction', 'down')->count();
    }

    public function getRank(){
        if($this->sumVoteScore()<10){
            return Rank::Find(1);
        }
        else if($this->sumVoteScore()<25 ){
            return Rank::Find(2);
        }
        else if($this->sumVoteScore()<50){
            return Rank::Find(3);
        }
        else if($this->sumVoteScore()<100){
            return Rank::Find(4);
        }
        else{
            return Rank::Find(5);
        }
    }
}
