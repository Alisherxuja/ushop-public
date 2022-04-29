<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\AttachmentResource;
use App\Http\Resources\Admin\ProductAttachmentsResource;
use App\Http\Resources\Admin\ProductSomeInfoResource;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Products\Product;
use App\Models\Base\Products\ProductAttachment;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class ProductsController extends Controller
{

    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->service->searchProduct($request)->paginate();
        return success_out(ProductSomeInfoResource::collection($products), true);
    }

    public function get(Product $product)
    {
        $product->attachments = AttachmentResource::collection($product->productAttachments);
        $product->p_category_id = $product->category->parent_id;
        return success_out($product);
    }

    public function create(ProductRequest $request)
    {
        try {
            if ($product = $this->service->create($request->validated()))
                return success_out($product);
        } catch (\Exception $e) {
            return error_out([], 422, $e->getMessage());
        }
        return error_out([], 422, 'Ошибка при создании товаров');
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            if ($this->service->update($request->validated(), $product))
                return success_out($product);
        } catch (\Exception $e) {
            return error_out([], 422, $e->getMessage());
        }
        return error_out([], 422, 'Ошибка обновления продуктов');
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return success_out($product);
        }
        return error_out([], 422, 'Ошибка при удалении данных');
    }

    public function attachments(Request $request, Product $product)
    {
        $data = $request->validate([
            'attachments' => 'required|array',
            'attachments.*.image' => 'required|string',
            'attachments.*.is_avatar' => 'required|boolean',
        ]);
        if ($this->service->addAttachments($data, $product)) {
            return success_out(['message' => 'Успешно добавлено']);
        }
        return error_out([], 422, 'Ошибка при добавлении новых изображений');
    }

    public function productAttachments(Product $product)
    {
        return success_out(ProductAttachmentsResource::collection($product->productAttachments));
    }

    public function destroyAttachment(ProductAttachment $attachment)
    {
        if ($attachment->delete()) {
            $this->dispatch(new RemoveFileJob($attachment->image));
            return success_out(ProductAttachmentsResource::make($attachment));
        }
        return error_out([], 422, 'Ошибка при удалении');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        $path = $request->file('image')->store('products', 'public');
        return success_out([
            'path' => $path,
            'url' => asset(\Storage::disk('public')->url($path), env('APP_SSL'))
        ]);
    }
}
