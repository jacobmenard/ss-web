<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'matchup_id' => $this->matchup_id,
            'matchup_notes' => $this->matchup_notes,
            'matchup_status' => $this->matchup_status,
            'event_id' => $this->event_id,
            'matchup_user' => new UserResource($this->matchup_user),
        ];
    }
}
