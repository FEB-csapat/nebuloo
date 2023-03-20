<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Question extends Model
{
    use HasFactory, HasTags;

    protected $table = 'questions';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'body', 'creator_user_id'];



    public static function search($value)
    {
        return Question
            ::where('title', $value)
            ->orWhere('body', $value);
    }

    public static function filterByTags($tags)
    {
        return Question::withAnyTags($tags);
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
}
