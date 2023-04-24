<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'body', 'creator_user_id', 'subject_id', 'topic_id'];


    public static function create(array $attributes = [])
    {
        $question = static::query()->create($attributes);

        // Create a default up vote for the question creator
        Vote::create([
            'owner_user_id' => $question->creator->id,
            'reciever_user_id' => $question->creator->id,
            'votable_type' => Question::class,
            'votable_id' => $question->id,
            'direction' => "up",
        ]);

        return $question;
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
        return route('questions.show', $this->id);
    }
}
