<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'creator_user_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
