<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductReviewInfoResource;
use App\Http\Resources\Admin\ProductReviewResource;
use App\Models\Base\Products\ProductReview;
use App\Models\Base\Products\ProductReviewAttachment;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = ProductReview::query()
            ->select(['product_reviews.*'])
            ->with(['product', 'user', 'order'])
            ->when($request->user, function ($query) use ($request) {
                $query->leftJoin('users as u', 'u.id', 'product_reviews.user_id')
                    ->where('u.name', 'ilike', "%$request->user%");
            })
            ->when($request->text, function ($query) use ($request) {
                $query->where('comment', 'ilike', "%$request->text%");
            })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->product, function ($query) use ($request) {
                $query->leftJoin('products as p', 'p.id', 'product_reviews.product_id')
                    ->where('p.name_ru', 'ilike', "%$request->product%")
                    ->orWhere('p.name_uz', 'ilike', "%$request->product%");
            })
            ->paginate();
        return success_out(ProductReviewResource::collection($reviews), true);
    }

    public function get(ProductReview $review)
    {
        return success_out(ProductReviewInfoResource::make($review));
    }

    public function change(Request $request, ProductReview $review)
    {
        $data = $request->validate([
            'status' => 'required|integer',
        ]);
        if ($review->update($data))
            return success_out($review);
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(ProductReview $review)
    {
        $review->productReviewAttachments()->delete();
        $review->delete();
        return success_out($review);
    }

    public function destroyAttachment(ProductReviewAttachment $attachment)
    {
        $attachment->delete();
        return success_out($attachment);
    }
}
