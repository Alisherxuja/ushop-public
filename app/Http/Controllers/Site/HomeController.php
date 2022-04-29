<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Base\Faq;
use App\Models\Base\Info\Brand;
use App\Models\Base\Orders\Cart;
use App\Models\Base\Orders\Order;
use App\Models\Base\Orders\OrderProduct;
use App\Models\Base\Products\Product;
use App\Models\Base\Products\ProductReview;
use App\Models\Base\Site\Ad;
use App\Models\Base\Site\Article;
use App\Models\Base\Site\Banner;
use App\Models\Base\Users\Wishlist;
use App\Models\Site\Category;
use App\Models\Site\Page;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::query()->where('status', Banner::STATUS_ACTIVE)->get();

        $categories = Category::query()
            ->with(['products'])
            ->whereHas('products')
            ->limit(5)
            ->inRandomOrder()
            ->get();

        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()->pluck('product_id')->toArray();

        $adds = Ad::query()->limit(5)->get()->toArray();

        return view('site.index', [
            'banners' => $banners,
            'categories' => $categories,
            'favoritePIds' => $favoritePIds,
            'adds' => $adds,
        ]);
    }

    public function category(Category $category)
    {
        if ($category->children()->count() > 0) {
            $cIds = $category->children()->pluck('id')->toArray();
        } else {
            $cIds = [$category->id];
        }

        $brands = Brand::query()
            ->select(['id', 'name', 'slug'])
            ->where('status', Brand::STATUS_ACTIVE)
            ->get();
        $products = Product::query()
            ->with(['productAttachments'])
            ->availableProducts()
            ->filterCategory()
            ->filterBrand()
            ->whereIn('category_id', $cIds)
            ->paginate();


        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()->pluck('product_id')->toArray();

        return view('site.category', [
            'products' => $products,
            'category' => $category,
            'brands' => $brands,
            'favoritePIds' => $favoritePIds,
        ]);
    }

    public function search()
    {
        $text = request('q');
        $products = Product::query()
            ->where('status', Product::STATUS_ACTIVE)
            ->when($text, function ($query) use ($text) {
                $query->where(function ($q) use ($text) {
                    $q->where('name_ru', 'ilike', "%$text%")
                        ->orWhere('name_uz', 'ilike', "%$text%");
                });
            })
            ->paginate();

        $brands = Brand::query()
            ->select(['id', 'name', 'slug'])
            ->where('status', Brand::STATUS_ACTIVE)
            ->get();

        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()
            ->pluck('product_id')
            ->toArray();

        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('status', Category::STATUS_ACTIVE)
            ->get();

        return view('site.search', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'favoritePIds' => $favoritePIds,
        ]);
    }

    public function product(\App\Models\Site\Product $product)
    {
        $banner = Banner::query()->where('status', Banner::STATUS_ACTIVE)->inRandomOrder()->first();
        $product->productAttachments;
        $recommends = Product::query()
            ->with(['productAttachments', 'productReviews'])
            ->availableProducts()
            ->whereNotIn('id', [$product->id])
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()->pluck('product_id')->toArray();

        return view('site.product', [
            'product' => $product,
            'recommends' => $recommends,
            'favoritePIds' => $favoritePIds,
            'banner' => $banner,
        ]);
    }

    public function rateSave(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating' => 'required',
            'file' => 'nullable|image',
            'comment' => 'required|string|max:255',
        ]);

        $order = Order::query()
            ->select(['order.*'])
            ->join('order_products as op', 'op.order_id', 'orders.id')
            ->where('orders.user_id', \Auth::guard('web')->id())
            ->where('op.product_id', $product->id)
            ->first();

        if (!$order) {
            return back()->with('no-order', 'У вас нет заказа');
        }

        ProductReview::query()->create([
            'user_id' => \Auth::guard('web')->id(),
            'order_id' => $order->id,
            'product_id' => $product->id,
            'rate' => $data['rating'],
            'file' => $data['file'],
            'comment' => $data['comment'],
            'status' => ProductReview::STATUS_SHOW,
        ]);

        return back()->withErrors($data);
    }

    public function productModalView(Product $product)
    {
        $product->productAttachments;

        return view('site.productModelView', [
            'product' => $product,
        ]);
    }

    public function news()
    {
        $articles = Article::query()
            ->where('status', Article::STATUS_ACTIVE)
            ->orderByDesc('id')
            ->get();
        return view('site.news', ['articles' => $articles]);
    }

    public function faq()
    {
        $faqs = Faq::query()->where('status', Faq::STATUS_SHOW)->get();
        return view('site.faq', ['faqs' => $faqs]);
    }

    public function favorite()
    {
        $favorites = Wishlist::query()
            ->with(['product'])->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get();
        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()->pluck('product_id')->toArray();

        return view('site.favorite', ['favorites' => $favorites, 'favoritePIds' => $favoritePIds,]);
    }

    public function addOrRemoveFavorite(Product $product)
    {
        $favorite = Wishlist::query()
            ->with(['product'])->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->where('product_id', $product->id)
            ->first();
        if ($favorite) {
            $favorite->delete();
            return back()->with('favorite_added', 'Product removed');
        } else {
            Wishlist::query()->create([
                'product_id' => $product->id,
                'uuid' => get_uuid(),
                'user_id' => optional(auth('web'))->id()
            ]);
            return back()->with('favorite_added', 'Product added');
        }
    }

    public function cart(Product $product)
    {
        Cart::query()->updateOrCreate(
            ['uuid' => get_uuid(), 'product_id' => $product->id],
            ['uuid' => get_uuid(), 'product_id' => $product->id, 'qty' => 1, 'user_id' => optional(auth('web'))->id()]
        );
        return back()->with('add_cart', 'Product successfully added to cart');
    }

    public function cartView()
    {
        $cart = Cart::query()
            ->select([
                'carts.*',
                DB::raw('(carts.qty * p.price) as product_price')
            ])
            ->leftJoin('products as p', 'p.id', 'carts.product_id')
            ->with(['product'])
            ->where(function ($query) {
                $query->where('carts.uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('carts.user_id', auth('web')->id());
                    });
            })
            ->get();

        $pIds = $cart->pluck('product_id')->toArray();

        $recommends = Product::query()
            ->with(['productAttachments'])
            ->availableProducts()
            ->whereNotIn('id', $pIds)
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $favoritePIds = Wishlist::query()
            ->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->get()->pluck('product_id')->toArray();

        return view('site.cart', ['cart' => $cart, 'recommends' => $recommends, 'favoritePIds' => $favoritePIds]);
    }

    public function cartDelete()
    {
        Cart::query()->with(['product'])
            ->where(function ($query) {
                $query->where('uuid', get_uuid())
                    ->when(!auth('web')->guest(), function ($q) {
                        $q->orWhere('user_id', auth('web')->id());
                    });
            })
            ->delete();
        return back()->with('add_cart', 'All product deleted from cart');
    }

    public function cartDeleteOne(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    public function cartMinus($id)
    {
        $cart = Cart::query()
            ->where('id', $id)
            ->first();
        if ($cart->qty > 1) {
            $cart->update(['qty' => $cart->qty - 1]);
            return response()->json();
        }
        return response()->json();
    }

    public function cartPlus($id)
    {
        $cart = Cart::query()
            ->where('id', $id)
            ->first();
        if ($cart->update(['qty' => $cart->qty + 1])) {
            return response()->json();
        }
        return response()->json();
    }

    public function faqCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'question' => 'required|string|max:255',
        ]);
        $data['phone'] = clearPhone($data['phone']);
        Faq::query()->create($data);
        return back()->with('success', 'Successfully send');
    }

    public function page(Page $page)
    {
        return view('site.page', ['page' => $page]);
    }

    public function aboutCompany()
    {
        return view('site.aboutCompany');
    }

    public function contacts()
    {
        return view('site.contacts');
    }

    public function payment()
    {
        return view('site.payment');
    }

    public function returnPage()
    {
        return view('site.return');
    }
}
