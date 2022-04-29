<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttachmentsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'is_avatar' => $this->is_avatar,
            'image' => $this->image,
            'image_url' => $this->image_url,
        ];
    }
}
