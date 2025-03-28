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
        return [
            'event_id' => $this->event_id,
            'user' => new UserResource($this->user),
            'feedback' => $this->feedbacks,
            'matchup_status' => $this->getStatus($this->event_id, $this->user->id)
        ];
    }

    public function getStatus($eventId, $matchupId) {
        $matchup = new MatchUp;
        return $matchup->where('event_id', $eventId)
                        ->where('user_id', Auth::user()->id)
                        ->where('matchup_id', $matchupId)
                        ->first();
    }
}
