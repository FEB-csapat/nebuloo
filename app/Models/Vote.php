<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;


    protected $table = 'votes';
    protected $primaryKey = 'id';


    public function owner()
    {
        return $this->belongsTo(User::class, 'id', 'owner_user_id');
    }

    public function granted()
    {
        return $this->belongsTo(User::class, 'id', 'granted_user_id');
    }

    public function voteable()
    {
        return $this->morphTo();
    }
}
