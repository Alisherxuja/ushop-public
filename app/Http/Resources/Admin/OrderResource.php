<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'address' => $this->orderAddress->address,
            'total_price' => $this->total_price,
            'courier' => optional($this->courier)->name,
            'uuid' => $this->uuid,
            'comment' => $this->comment,
            'status' => $this->status,
            'status_name' => $this->status_name,
            'date' => $this->created_at
        ];
    }
}
