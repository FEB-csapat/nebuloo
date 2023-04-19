<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Content extends Model
{
    use HasFactory, HasTags;

    protected $table = 'contents';
    protected $primaryKey = 'id';


    protected $fillable = ['title', 'body', 'creator_user_id'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function topic()
    {
        return $this->hasOne(Topic::class, 'id');
    }

    public function sumVoteScore(){
        return $this->votes->where('direction', 'up')->count()
        - $this->votes->where('direction', 'down')->count();
    }

    public function getSumVoteScoreAttribute(){
        return $this->votes->where('direction', 'up')->count()
        - $this->votes->where('direction', 'down')->count();
    }

    public function url(){
        return route('contents.show', $this->id);
    }
}
