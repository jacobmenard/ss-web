<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->profile_image) {
            $profileImage = config('app.url') . '/storage/' . $this->profile_image;
        } else {
            $profileImage = null;
        }
        return [
            'id' => $this->id,
            'eventbrite_id' => $this->eventbrite_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'cell_phone' => $this->cell_phone,
            'gender' => $this->gender,
            'age' => $this->age,
            'user_detail' => $this->user_detail,
            'user_events' => $this->user_events,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'profile_image' => $profileImage,
            'is_changed_password' => $this->is_changed_password
        ];
    }
}
