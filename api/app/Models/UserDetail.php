<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'address',
        'contact_number',
        'preferred_gender',
        'preferred_height_from',
        'preferred_height_to',
        'preferred_age_from',
        'preferred_age_to',
        'created_at',
        'updated_at'
    ];
    
}
