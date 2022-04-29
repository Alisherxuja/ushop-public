<?php


namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewInfoResource extends ProductReviewResource
{
    public function toArray($request): array
    {
        return array_merge(
            parent::toArray($request),
            [
                'pros' => $this->pros,
                'cons' => $this->cons,
                'attachments' => $this->productReviewAttachments,
            ]
        );
    }
}
