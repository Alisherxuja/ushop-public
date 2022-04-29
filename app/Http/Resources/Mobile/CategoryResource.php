<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . app()->getLocale()},
            'children' => \App\Http\Resources\Telegram\CategoryResource::collection($this->children)
        ];
    }
}