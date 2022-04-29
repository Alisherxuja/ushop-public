<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\ProductListResource;
use App\Http\Resources\Telegram\CategoryResource;
use App\Models\Base\Info\Category;
use App\Models\Base\Products\Product;

class CategoryController extends Controller
{
    public function all()
    {
        $parents = Category::query()
            ->where('status', Category::STATUS_ACTIVE)
            ->orderBy('id')
            ->get();

        return success_out(CategoryResource::collection($parents));
    }

    public function parents()
    {
        $parents = Category::query()
            ->whereNull('parent_id')
            ->where('status', Category::STATUS_ACTIVE)
            ->get();

        return success_out(CategoryResource::collection($parents));
    }

    public function parentWithChild()
    {
        $parents = Category::query()
            ->with(['children'])
            ->whereNull('parent_id')
            ->where('status', Category::STATUS_ACTIVE)
            ->get();

        return success_out(\App\Http\Resources\Mobile\CategoryResource::collection($parents));
    }

    public function child(Category $category)
    {
        $children = $category->children()->where('status', Category::STATUS_ACTIVE)->get();
        return success_out(CategoryResource::collection($children));
    }

    public function products(Category $category)
    {

        if ($category->children()->count() > 0) {
            $cIds = $category->children()->pluck('id')->toArray();
        } else {
            $cIds = [$category->id];
        }

        $products = Product::query()
            ->with(['category', 'brand', 'measure'])
            ->whereIn('category_id', $cIds)
            ->availableProducts()
            ->orderByDesc('id')
            ->paginate(request('per_page', 15));
        return success_out(ProductListResource::collection($products), true);
    }

}