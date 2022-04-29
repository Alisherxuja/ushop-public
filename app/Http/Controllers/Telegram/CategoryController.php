<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Resources\Telegram\CategoryResource;
use App\Models\Base\Info\Category;

class CategoryController extends Controller
{
    public function parents()
    {
        $parents = Category::query()
            ->whereNull('parent_id')
            ->where('status', Category::STATUS_ACTIVE)
            ->get();

        return success_out(CategoryResource::collection($parents));
    }

    public function child(Category $category)
    {
        $children = $category->children()->where('status', Category::STATUS_ACTIVE)->get();
        return success_out(CategoryResource::collection($children));
    }
}