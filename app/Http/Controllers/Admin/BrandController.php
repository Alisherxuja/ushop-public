<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Resources\Admin\BrandResource;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Info\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function list()
    {
        $brands = Brand::query()
            ->select(['id', 'name'])
            ->where('status', Brand::STATUS_ACTIVE)->get();
        return success_out($brands);
    }

    public function index(Request $request)
    {
        $brands = Brand::search($request)->orderBy('id')->paginate();
        return success_out(BrandResource::collection($brands), true);
    }

    public function get(Brand $brand)
    {
        return success_out($this->getResource($brand));
    }

    public function create(BrandRequest $request)
    {
        $data = $request->validated();
        $brand = new Brand();
        if ($request->has('file')) {
            $data['logo'] = $request->file('file')->store('brands', 'public');
        }
        $brand->fill($data);
        if ($brand->save()) {
            if ($request->has('categories')) {
                $brand->categoryBrands()->createMany($data['categories']);
            }
            return success_out($this->getResource($brand));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $path = $brand->logo;
            $data['logo'] = $request->file('file')->store('brands', 'public');
        }
        if ($brand->update($data)) {
            if ($request->has('categories')) {
                $brand->categoryBrands()->delete();
                $brand->categoryBrands()->createMany($data['categories']);
            }
            if (isset($path)) {
                $this->dispatch(new RemoveFileJob($path));
            }
            return success_out($this->getResource($brand));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->delete()) {
            $this->dispatch(new RemoveFileJob($brand->logo));
            return success_out($this->getResource($brand));
        }
        return error_out(['message' => 'Ошибка при удалении'], 422, 'Ошибка при удалении');
    }

    private function getResource(Brand $brand): array
    {
        return [
            'id' => $brand->id,
            'name' => $brand->name,
            'slug' => $brand->slug,
            'status' => $brand->status,
            'is_popular' => $brand->is_popular,
            'logo_url' => $brand->logo_url,
            'category_brands' => $brand->categoryBrands,
        ];
    }
}
