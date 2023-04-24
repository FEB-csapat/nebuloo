<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';
    protected $primaryKey = 'id';


    protected $fillable = ['name', 'creator_user_id', 'subject_id'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
