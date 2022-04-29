<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'location_id' => $this->location_id,
            'location' => optional($this->location)->{'name_'.\App::getLocale()},
            'address' => $this->address,
            'coordinates' => $this->coordinates,
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'landmark' => $this->landmark,
            'label' => $this->label,
            'is_default' => $this->is_default,
        ];
    }
}
