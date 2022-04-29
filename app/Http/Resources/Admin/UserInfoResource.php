<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'roles' => $this->roles()->plunk('name'),
            'complaints' => ComplaintResource::collection($this->complaints),
            'addresses' => UserAddressResource::collection($this->addresses),
            'orders' => OrderResource::collection($this->orders),
            'wishlists' => WishlistResource::collection($this->wishlists),
        ];
    }
}
