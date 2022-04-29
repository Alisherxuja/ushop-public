<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductSomeInfoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'avatar' => optional($this->avatar)->image_url,
            'sku' => $this->sku,
            'status' => $this->status,
            'price' => $this->price,
            'discount' => $this->discount,
            'old_price' => $this->old_price,
            'stock' => $this->stock,
            'unicode' => $this->unicode,
            'name' => $this->{'name_' . \App::getLocale()},
            'brand' => $this->brand_name,
            'category' => $this->{'category_name_' . \App::getLocale()},
            'measure_name' => $this->{'measure_name_' . \App::getLocale()},
        ];
    }
}
