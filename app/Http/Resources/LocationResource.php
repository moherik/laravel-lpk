<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address,
            'lat_long' => $this->lat_long,
            'description' => $this->description,
            'phone' => $this->phone,
            'wesite' => $this->website,
            'location_type' => $this->type->title,
            'created_at' => $this->created_at->format('h:i:s d-m-Y'),
        ];
    }
}
