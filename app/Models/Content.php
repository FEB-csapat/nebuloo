<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table = 'contents';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'body', 'creator_user_id', 'subject_id', 'topic_id'];

    public static function create(array $attributes = [])
    {
        $content = static::query()->create($attributes);

        // Create a default up vote for the content creator
        Vote::create(
            [
                'creator_user_id' => $content->creator->id,
                'reciever_user_id' => $content->creator->id,
                'votable_type' => Content::class,
                'votable_id' => $content->id,
                'direction' => "up",
            ]
        );

        return $content;
    }
    

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
        return $this->hasOne(Topic::class, 'id', 'topic_id');
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
        return env('APP_URL').'/contents/'.$this->id;
    }
}
