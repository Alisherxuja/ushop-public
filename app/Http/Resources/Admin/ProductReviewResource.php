<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'rate' => $this->rate,
            'status' => $this->status,
            'comment' => $this->comment,
            'user' => [
                'id' => optional($this->user)->id,
                'name' => optional($this->user)->name
            ],
            'order' => [
                'id' => optional($this->order)->id,
                'uuid' => optional($this->order)->uuid
            ],
            'product' => [
                'id' => optional($this->product)->id,
                'name' => optional($this->product)->{'name_' . \App::getLocale()},
            ]
        ];
    }
}
