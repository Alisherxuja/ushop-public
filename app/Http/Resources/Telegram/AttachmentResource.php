<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image_url
        ];
    }
}