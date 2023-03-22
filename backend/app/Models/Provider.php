<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    
    protected $table = 'providers';
    protected $primaryKey = 'id';

    protected $fillable = ['provider', 'provider_id', 'user_id', 'avatar'];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    

}
