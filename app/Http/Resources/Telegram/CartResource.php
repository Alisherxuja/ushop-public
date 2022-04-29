<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'qty' => $this->qty,
            'product' => ProductListResource::make($this->product)
        ];
    }
}