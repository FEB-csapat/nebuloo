<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = ['message', 'creator_user_id', 'commentable_id', 'commentable_type'];

    public static function create(array $attributes = [])
    {
        $comment = static::query()->create($attributes);

        // Create a default up vote for the comment creator
        Vote::create([
            'creator_user_id' => $comment->creator->id,
            'reciever_user_id' => $comment->creator->id,
            'votable_type' => Comment::class,
            'votable_id' => $comment->id,
            'direction' => "up",
        ]);

        return $comment;
    }


    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function sumVoteScore(){
        return $this->votes->where('direction', 'up')->count()
        - $this->votes->where('direction', 'down')->count();
    }

    public function url(){
        return $this->commentable->url() . '/comments/' . $this->id;
    }
}
