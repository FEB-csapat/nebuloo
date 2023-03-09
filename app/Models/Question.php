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


    public function creator()
    {
        return $this->belongsTo(User::class, 'id', 'creator_user_id');
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
