<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'event_id', 'matchup_id', 'matchup_status', 'matchup_notes'
    ];

    
    public function matchup_user() {
        return $this->belongsTo(User::class, 'matchup_id');
    }

    public function matchup_owner() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
