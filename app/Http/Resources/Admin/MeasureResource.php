<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class MeasureResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->{'name_'.app()->getLocale()},
            'symbol_ru' => $this->{'symbol_'.app()->getLocale()},
            'status' => $this->status,
        ];
    }
}
