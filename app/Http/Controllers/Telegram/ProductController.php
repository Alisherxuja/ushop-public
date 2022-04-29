<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Resources\Telegram\ProductListResource;
use App\Http\Resources\Telegram\ProductResource;
use App\Models\Base\Info\Category;
use App\Models\Base\Products\Product;

class ProductController extends Controller
{
    public function index(Category $category)
    {
        if ($category->children()->count() > 0) {
            $cIds = $category->children()->pluck('id')->toArray();
        } else {
            $cIds = [$category->id];
        }

        $products = Product::query()
            ->with(['productAttachments', 'measure'])
            ->availableProducts()
            ->filterCategory()
            ->filterBrand()
            ->whereIn('category_id', $cIds)
            ->get();

        return success_out(ProductListResource::collection($products));
    }

    public function get(Product $product)
    {
        return success_out(ProductResource::make($product));
    }
}