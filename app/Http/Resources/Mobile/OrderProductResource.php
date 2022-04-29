<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $lang = app()->getLocale();
        return [
            'id' => $this->id,
            'qty' => $this->qty,
            "price" => $this->price,
            "discount" => $this->discount,
            "old_price" => $this->old_price,
            "product" => [
                "id" => $this->id,
                "category" => optional(optional($this->product)->category)->{'name_' . $lang},
                "brand" => optional(optional($this->product)->brand)->name,
                "measure_name" => optional(optional($this->product)->measure)->{'name_' . $lang},
                "measure_symbol" => optional(optional($this->product)->measure)->{'symbol_' . $lang},
                "name" => optional($this->product)->{'name_' . $lang},
                "sku" => optional($this->product)->sku,
                "unicode" => optional($this->product)->unicode,
                "avatar" => optional($this->product)->avatar,
            ],
        ];
    }
}