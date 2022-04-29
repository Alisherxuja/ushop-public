<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id"=> $this->id,
            "user_id"=> $this->user_id,
            "order_address"=>[
                'name' => optional($this->orderAddress)->name,
                'phone' => optional($this->orderAddress)->phone,
                'address' => optional($this->orderAddress)->address,
                'location' => optional(optional($this->orderAddress)->location)->{'name_'.app()->getLocale()},
            ],
            "payment_type"=> optional($this->paymentType)->{'name_'.app()->getLocale()},
            "price"=> $this->price,
            "delivery_price"=> $this->delivery_price,
            "total_price"=> $this->total_price,
            "comment"=> $this->comment,
            "status"=> $this->status,
            "status_name"=> $this->status_name,
            "created_at"=> $this->created_at,
            "orderProducts" => OrderProductResource::collection($this->orderProducts)
        ];
    }
}