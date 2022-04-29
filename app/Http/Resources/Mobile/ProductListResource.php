<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    public function toArray($request): array
    {
        $lang = app()->getLocale();
        return [
            "id" => $this->id,
            "category" => optional($this->category)->{'name_' . $lang},
            "brand" => optional($this->brand)->name,
            "measure_name" => optional($this->measure)->{'name_' . $lang},
            "measure_symbol" => optional($this->measure)->{'symbol_' . $lang},
            "name" => $this->{'name_' . $lang},
            "sku" => $this->sku,
            "unicode" => $this->unicode,
            "price" => $this->price,
            "discount" => $this->discount,
            "old_price" => $this->old_price,
            "avatar" => $this->avatar,
        ];
    }
}