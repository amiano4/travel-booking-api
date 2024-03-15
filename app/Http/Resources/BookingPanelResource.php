<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingPanelResource extends JsonResource
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
            '_id' => str_pad($this->id, 6, "0", STR_PAD_LEFT),
            'fullname' => $this->fullname,
            'date' => $this->event_date->format('Y-m-d'),
            'email' => $this->email,
            'contact' => $this->contact,
            'locals' => $this->local_guests,
            'foreigns' => $this->foreign_guests,
            'pick_up' => $this->pick_up_info,
            'request' => $this->special_request,
            'product' => $this->product,
            'at' => $this->created_at->format('Y-m-d h:i:s A'),
        ];
    }
}