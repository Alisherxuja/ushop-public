<?php


namespace App\Http\View\Composers\Site;

use App\Models\Base\Info\Category;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Page;
use App\Models\Base\Settings\Setting;
use App\Models\Base\Users\Wishlist;
use Illuminate\View\View;

class SiteHeaderComposer
{
    public function compose(View $view)
    {
        $view->with([
            'contact' => Setting::query()->first(),
            'categories' => Category::query()
                ->with(['children'])
                ->select(['id', 'slug', 'name_' . app()->getLocale() . ' as name'])
                ->where('status', Category::STATUS_ACTIVE)
                ->whereNull('parent_id')
                ->get(),
            'cart' => Cart::query()
                ->select([
                    'carts.*',
                    \DB::raw('(carts.qty * p.price) as product_price')
                ])
                ->leftJoin('products as p', 'p.id', 'carts.product_id')
                ->with(['product'])
                ->where(function ($query) {
                    $query->where('carts.uuid', get_uuid())
                        ->when(!auth('web')->guest(), function ($q) {
                            $q->orWhere('carts.user_id', auth('web')->id());
                        });
                })
                ->get(),
            'pages' => Page::query()->orderBy('id')->get()
        ]);
    }
}
