<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'avatar' => optional($this->avatar)->image_url,
            'id' => $this->id,
            'sku' => $this->sku,
            'status' => $this->status,
            'name' => $this->group->{'name_' . \App::getLocale()},
            'group_id' => $this->group_id,
            'group_name' => optional($this->group)->{'name_' . \App::getLocale()},
            'brand_id' => $this->group->brand_id,
            'brand_name' => $this->group->brand->name,
            'category_id' => $this->group->category_id,
            'category_name' => $this->group->category->{'name_' . \App::getLocale()},
            'measure_id' => $this->group->measure_id,
            'measure_name' => optional($this->group->measure)->{'name_' . \App::getLocale()},
        ];
    }
}
