<?php


namespace App\Services\Site;


use App\Http\Resources\Site\Search\BrandResource;
use App\Http\Resources\Site\Search\CategoryResource;
use App\Http\Resources\Site\Search\ProductResource;
use App\Models\Base\Products\VwProduct;
use App\Models\Site\Info\Brand;
use App\Models\Site\Info\Category;
use App\Models\Site\Products\Product;
use Illuminate\Http\Request;

class SearchService
{
    public static function brands(Request $request)
    {
        //$limit = $request->get('per_page', 15);
        $text = $request->get('q', '');
        $textEng = rus_to_end($text);

        $brands = Brand::query()
            ->where('status', Brand::STATUS_ACTIVE)
            ->where(function ($query) use ($textEng, $text) {
                $query->where('name', 'ilike', $text . '%')
                    ->orWhere('name', 'ilike', $textEng . '%');
            })
            //->limit($limit)
            ->get();

        return BrandResource::collection($brands);
    }

    public static function categories(Request $request)
    {
//        $limit = $request->get('per_page', 15);
        $text = $request->get('q', '');
        $textEng = rus_to_end($text);

        $categories = Category::query()
            ->with(['parent'])
            ->where('status', Category::STATUS_ACTIVE)
            ->where(function ($q) use ($text) {
                $q->where('name_ru', 'ilike', '%' . $text . '%')
                    ->orWhere('name_uz', 'ilike', '%' . $text . '%');
            })
            ->orWhere(function ($q) use ($textEng) {
                $q->where('name_ru', 'ilike', '%' . $textEng . '%')
                    ->orWhere('name_uz', 'ilike', '%' . $textEng . '%');
            })
//            ->limit($limit)
            ->get();
        return CategoryResource::collection($categories);
    }

    public static function products(Request $request)
    {
        //$limit = $request->get('per_page', 15);
        $text = $request->get('q', '');
        $textEng = rus_to_end($text);

        $products = VwProduct::query()
            ->with(['category'])
            ->where(function ($q) use ($text) {
                $q->where('name_ru', 'ilike', '%' . $text . '%')
                    ->orWhere('name_uz', 'ilike', '%' . $text . '%');
            })
            ->orWhere(function ($q) use ($textEng) {
                $q->where('name_ru', 'ilike', '%' . $textEng . '%')
                    ->orWhere('name_uz', 'ilike', '%' . $textEng . '%');
            })
            ->orWhere(function ($q) use ($text) {
                $q->where('category_name_ru', 'ilike', '%' . $text . '%')
                    ->orWhere('category_name_uz', 'ilike', '%' . $text . '%');
            })
            ->orWhere(function ($q) use ($textEng) {
                $q->where('category_name_ru', 'ilike', '%' . $textEng . '%')
                    ->orWhere('category_name_uz', 'ilike', '%' . $textEng . '%');
            })
            ->orWhere(function ($q) use ($text, $textEng) {
                $q->where('brand_name', 'ilike', '%' . $text . '%')
                    ->orWhere('brand_name', 'ilike', '%' . $textEng . '%');
            })
            ->orWhere(function ($q) use ($text, $textEng) {
                $q->where('keywords', 'ilike', '%' . $text . '%')
                    ->orWhere('keywords', 'ilike', '%' . $textEng . '%');
            })
            ->orWhere(function ($q) use ($text, $textEng) {
                $q->where('description', 'ilike', '%' . $text . '%')
                    ->orWhere('description', 'ilike', '%' . $textEng . '%');
            })
            ->get();
        return ProductResource::collection($products);
    }
}
