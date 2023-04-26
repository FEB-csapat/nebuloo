<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'id';

    protected $fillable = ['path'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

}
