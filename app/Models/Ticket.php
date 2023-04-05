<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $fillable = ['state','body','creator_user_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

}
