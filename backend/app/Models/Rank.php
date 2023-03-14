<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $table = 'ranks';
    protected $primaryKey = 'id';


    public function users()
    {
        return $this->hasMany(User::class, 'rank_id', 'id');
    }

}
