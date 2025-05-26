<?php

namespace App\Models;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'user_id', 'event_status', 'is_share_contact', 'is_checkin'
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function feedbacks() {
        return $this->hasOne(Feedback::class);
    }
    
}
