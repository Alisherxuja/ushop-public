<?php

namespace App\Http\Controllers\Mobile;


use App\Http\Resources\Mobile\ProductListResource;
use App\Http\Resources\Mobile\ProductResource;
use App\Models\Base\Products\Product;

class ProductController
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'brand', 'measure'])
            ->availableProducts()
            ->filter()
            ->orderByDesc('id')
            ->paginate(request('per_page', 15));
        return success_out(ProductListResource::collection($products), true);
    }

    public function list()
    {
        $products = Product::query()
            ->with(['category', 'brand', 'measure'])
            ->availableProducts()
            ->orderByDesc('id')
            ->get();
        return success_out(ProductListResource::collection($products));
    }

    public function get(Product $product)
    {
        return success_out(ProductResource::make($product));
    }
}