<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;


    protected $table = 'votes';
    protected $primaryKey = 'id';


    protected $fillable = ['votable_type', 'votable_id', 'direction', 'owner_user_id', 'granted_user_id'];


    public function owner()
    {
        return $this->belongsTo(User::class, 'id', 'owner_user_id');
    }

    public function granted()
    {
        return $this->belongsTo(User::class, 'id', 'granted_user_id');
    }

    public function votable()
    {
        return $this->morphTo();
    }
}
