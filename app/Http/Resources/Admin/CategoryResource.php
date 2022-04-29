<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'parent_name' => optional($this->parent)->{'name_ru' . \App::getLocale()},
            'name_uz' => $this->name_uz,
            'name_ru' => $this->name_ru,
            'is_popular' => $this->is_popular,
            'status' => $this->status,
            'image_url' => $this->image_url,
            'children' => CategoryResource::collection($this->children)
        ];
    }
}
