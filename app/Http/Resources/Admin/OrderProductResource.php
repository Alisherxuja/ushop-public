<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'avatar' => optional($this->product)->avatar,
            'name' => $this->product->{'name_' . \App::getLocale()},
            'brand_name' => $this->product->brand->name,
            'category_name' => $this->product->category->{'name_' . \App::getLocale()},
            'qty' => $this->qty,
            'discount' => $this->discount,
            'price' => $this->price,
            'status' => $this->status,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
        ];
    }
}
