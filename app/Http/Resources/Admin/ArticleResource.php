<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title_ru' => $this->title_ru,
            'title_uz' => $this->title_uz,
            'content_ru' => $this->content_ru,
            'content_uz' => $this->content_uz,
            'view_count' => $this->view_count,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'status' => $this->status,
            'attachments' => ArticleAttachmentResource::collection($this->attachments)
        ];
    }
}
