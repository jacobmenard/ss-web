<?php

namespace App\Http\Resources;

use App\Models\MatchUp;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = new UserResource($this->user);
        return [
            'id' => $this->id,
            'slug' => $user->name ? str_slug($user->name) : null,
            'event_id' => $this->event_id,
            'user' => $user,
            'feedback' => $this->feedbacks,
            'matchup_status' => $this->getStatus($this->event_id, $this->user->id),
            'is_share_contact' => $this->is_share_contact,
            'is_checkin' => $this->is_checkin
        ];
    }

    public function getStatus($eventId, $matchupId) {
        $matchup = new MatchUp;
        return $matchup->where('event_id', $eventId)
                        ->where('user_id', Auth::user() ? Auth::user()->id : 0)
                        ->where('matchup_id', $matchupId)
                        ->first();
    }
}
