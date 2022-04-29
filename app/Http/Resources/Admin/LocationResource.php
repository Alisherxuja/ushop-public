<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name_uz' => $this->name_uz,
            'name_ru' => $this->name_ru,
            //'has_delivery' => $this->has_delivery,
            'status' => $this->status,
            'children' => LocationResource::collection($this->children),
        ];
    }
}