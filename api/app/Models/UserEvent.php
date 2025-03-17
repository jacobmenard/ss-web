<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'user_id', 'event_status', 'is_share_contact'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
