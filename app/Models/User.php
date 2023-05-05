<?php

namespace App\Models;

use App\Mail\ContentCommentMailNotify;
use App\Mail\QuestionCommentMailNotify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
class User extends Authenticatable
{
    use HasFactory, HasApiTokens;
    
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $hidden = [
        'remember_token',
        'password',
        'notify_by_email'
    ];

    protected $fillable = [
        'email', 'username', 'display_name', 'bio', 'password','banned', 'role'
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isModerator()
    {
        return $this->role == 'moderator';
    }

    public function isUser()
    {
        return $this->role == 'user';
    }

    public function setRoleToAdmin()
    {
        $this->role = 'admin';
        $this->save();
    }

    public function setRoleToModerator()
    {
        $this->role = 'moderator';
        $this->save();
    }

    public function setRoleToUser()
    {
        $this->role = 'user';
        $this->save();
    }

    public function setRole(string $role)
    {
        $this->role = $role;
        $this->save();
    }

    public function hasAnyRole(array $roles)
    {
        return in_array($this->role, $roles);
    }

    

    public function ownedVotes()
    {
        return $this->hasMany(Vote::class, 'creator_user_id');
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
        return $this->hasMany(Comment::class, 'creator_user_id');
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

    public function notifyNewCommentToCommentable(Comment $comment, string $commentableClass)
    {
        if(! $this->notify_by_email){
            return;
        }
        if($commentableClass == Content::class){

            Mail::to($this->email)->send(new ContentCommentMailNotify($comment));

        }else {
            Mail::to($this->email)->send(new QuestionCommentMailNotify($comment));
        }
    }

}
