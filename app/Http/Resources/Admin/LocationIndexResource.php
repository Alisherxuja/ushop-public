<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationIndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'parent_name' => optional($this->parent)->{'name_'.app()->getLocale()},
            'name' => $this->name_ru,
            'status' => $this->status,
        ];
    }
}