<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product' => ProductListResource::make($this->product)
        ];
    }
}