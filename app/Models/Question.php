<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';


    public function creator()
    {
        return $this->belongsTo(User::class, 'id', 'creator_user_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'id', 'voteable_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
