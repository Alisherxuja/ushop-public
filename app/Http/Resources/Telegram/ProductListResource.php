<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . app()->getLocale()},
            'measure' => optional($this->measure)->{'name_' . app()->getLocale()},
            'measure_short' => optional($this->measure)->{'symbol_' . app()->getLocale()},
            'price' => $this->price,
            'stock' => $this->stock,
            'old_price' => $this->old_price,
            'sku' => $this->sku,
            'avatar' => $this->avatar,
        ];
    }
}