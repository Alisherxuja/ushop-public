<?php

namespace App\Http\Resources\Telegram;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_' . app()->getLocale()},
            'brand' => optional($this->brand)->name,
            'measure' => optional($this->measure)->{'name_' . app()->getLocale()},
            'measure_symbol' => optional($this->measure)->{'symbol_' . app()->getLocale()},
            'sku' => $this->sku,
            'price' => $this->price,
            'discount' => $this->discount,
            'old_price' => $this->old_price,
            'stock' => $this->stock,
            'avatar' => $this->avatar,
            'attachments' => AttachmentResource::collection($this->productAttachments)
        ];
    }
}