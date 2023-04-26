<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'creator_user_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'subject_id');
    }
}
