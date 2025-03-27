<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'user_event_id',
        'host_points',
        'host_feedback',
        'venue_points',
        'venue_feedback',
        'event_points',
        'event_feedback',
        'website_points',
        'website_feedback',
        'other_feedback',
    ];
}
