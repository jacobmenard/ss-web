<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserEventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'user_event_id' => $this->user_event_id,
            'event_feedback' => $this->event_feedback,
            'event_points' => $this->event_points,
            'host_feedback' => $this->host_feedback,
            'host_points' => $this->host_points,
            'venue_feedback' => $this->venue_feedback,
            'venue_points' => $this->venue_points,
            'website_feedback' => $this->website_feedback,
            'website_points' => $this->website_points,
            'event' => new UserEventResource($this->event),
            'created_at_human' => Carbon::parse($this->created_at)->diffForHumans(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            
        ];
    }
}
