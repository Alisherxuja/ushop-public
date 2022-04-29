<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'icon' => $this->image_url,
            'name' => $this->{'name_' . app()->getLocale()}
        ];
    }
}