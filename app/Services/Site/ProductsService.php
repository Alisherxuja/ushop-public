<?php


namespace App\Services\Site;

use App\Models\Base\Products\VwProduct;
use App\Models\Site\Info\Category;
use App\Models\Site\Info\CategorySlug;
use App\Models\Site\Products\Product;
use App\Models\Site\Products\ProductReview;
use App\Models\Site\Products\ProductSlug;
use App\Models\Site\Users\UserProductsHistory;
use Auth;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProductsService
{
    public function filter(CategorySlug $category, Request $request): LengthAwarePaginator
    {
        return VwProduct::query()
            ->select('vw_products.*')
            ->with(['group.shortFeatureValues.feature', 'group.shortFeatureValues.value', 'avatar'])
            ->leftJoin('product_groups as pg', 'pg.id', 'vw_products.group_id')
            ->withAvg('productReviews', 'rate')
            ->where('pg.category_id', $category->id)
            ->filterByFeatures()
            ->filterByBrands()
            ->filterByPrice()
            ->orderByAsdDesc()
            ->paginate();
    }

    public function findOne(string $slug)
    {
        return VwProduct::query()
            ->select('vw_products.*')
            ->with(['group.featureValues.feature', 'group.featureValues.value', 'group.mainFeatures', 'productAttachments',
                'productComplects.complectProduct.avatar', 'siblings'])
            ->withAvg('productReviews', 'rate')
            ->withCount('productReviews')
            ->where('vw_products.slug', $slug)
            ->firstOrFail();
    }

    public function similarProducts(ProductSlug $product)
    {
        $categories = Category::query()->where('parent_id', $product->group->category->parent_id)->get()->pluck('id');
        return VwProduct::query()
            ->select('vw_products.*')
            ->with(['avatar', 'group.category'])
            ->withAvg('productReviews', 'rate')
            ->whereIn('category_id', $categories)
            ->where('vw_products.id', '<>', $product->id)
            ->inRandomOrder()
            ->limit(12)
            ->get();
    }

    public function recommendedProducts(ProductSlug $product)
    {
        return VwProduct::query()
            ->select('vw_products.*')
            ->with(['avatar', 'group.category'])
            ->withAvg('productReviews', 'rate')
            ->where('category_id', $product->group->category_id)
            ->where('vw_products.id', '<>', $product->id)
            ->inRandomOrder()
            ->limit(12)
            ->get();
    }

    public function reviews(ProductSlug $product)
    {
        return ProductReview::query()->where('product_id', $product->id)
            ->with(['attachments', 'user'])
            ->get();
    }

    public function rates(ProductSlug $product)
    {
        return DB::table('product_reviews as pr')
            ->selectRaw('count(rate) filter ( where rate = 5 ) as five_rate,
               count(rate) filter ( where rate = 4 ) as four_rate,
               count(rate) filter ( where rate = 3 ) as three_rate,
               count(rate) filter ( where rate = 2 ) as two_rate,
               count(rate) filter ( where rate = 1 ) as one_rate'
            )->where('product_id', $product->id)
            ->groupBy('product_id')
            ->first();
    }

    public function setProductHistoryToUser(\App\Models\Base\Products\Product $product): void
    {
        if (!Auth::guest())
            UserProductsHistory::query()->updateOrCreate([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ], [
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
        else {
            if (get_uuid()) {
                UserProductsHistory::query()->updateOrCreate([
                    'uuid' => get_uuid()
                ], [
                    'uuid' => get_uuid(),
                    'product_id' => $product->id
                ]);
            }
        }
    }

    public function userProductVisitHistory()
    {
        $products = UserProductsHistory::query()
            ->selectRaw('p.*, user_products_histories.product_id')
            ->leftJoin('products as p', 'p.id', 'user_products_histories.product_id')
            ->leftJoin('product_groups as pg', 'pg.id', 'p.group_id')
            ->with(['avatar', 'group.category'])
            ->withAvg('productReviews', 'rate');
        if (!Auth::guest()) {
            $products = $products->where('user_id', Auth::id());
        } else {
            if (get_uuid())
                $products = $products->where('uuid', get_uuid());
            else
                return [];
        }

        return $products->orderByDesc('id')
            ->limit(12)
            ->get();
    }
}
