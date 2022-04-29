<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'is_main' => $this->is_main,
            'url' => $this->url,
            'image_url' => $this->image_url,
            'status' => $this->status,
        ];
    }
}
