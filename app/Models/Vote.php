<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'votes';
    protected $primaryKey = 'id';


    protected $fillable = ['votable_type', 'votable_id', 'direction', 'creator_user_id', 'reciever_user_id'];


    public function owner()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_user_id');
    }

    public function votable()
    {
        return $this->morphTo();
    }
}
