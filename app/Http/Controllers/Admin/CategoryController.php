<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryParentListResource;
use App\Http\Resources\Admin\CategoryParentResource;
use App\Http\Resources\Admin\CategoryResource;
use App\Jobs\Admin\RemoveFileJob;
use App\Models\Base\Info\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function parentListWithChildren()
    {
        $categories = Category::query()
            ->with(['children'])
            ->whereNull('parent_id')
            ->where('status', Category::STATUS_ACTIVE)
            ->get();
        return success_out(CategoryParentResource::collection($categories));
    }

    public function parentList()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->get();
        return success_out(CategoryParentListResource::collection($categories));
    }

    public function index(Request $request)
    {
        $categories = Category::query()
            ->select(['categories.*'])
            ->with(['parent', 'children'])
            ->when($request->name, function (Builder $query) use ($request) {
                $query->where('name_ru', 'ilike', '%' . $request->name . '%')
                    ->orWhere('name_uz', 'ilike', '%' . $request->name . '%');
            })
            ->when(!is_null($request->status), function (Builder $query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->parent, function (Builder $query) use ($request) {
                $query->leftJoin('categories as p', 'p.id', 'categories.parent_id')
                    ->where('p.name_ru', 'ilike', '%' . $request->parent . '%')
                    ->orWhere('p.name_uz', 'ilike', '%' . $request->parent . '%');
            })
            ->whereNull('parent_id')
            ->paginate();
        return success_out(CategoryResource::collection($categories), true);
    }

    public function get(Category $category)
    {
        return success_out($this->getResource($category));
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->has('file')) {
            $data['image'] = $request->file('file')->store('categories', 'public');
        }
        $category = new Category();
        $category->fill($data);
        if ($category->save()) {
            if (isset($data['brands'])) {
                $brands = collect($data['brands'])->map(function ($b) {
                    return ['brand_id' => $b];
                });
                $category->categoryBrands()->createMany($brands);
            }
            return success_out($this->getResource($category));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        if ($request->has('file')) {
            $file = $category->image;
            $data['image'] = $request->file('file')->store('categories', 'public');
        }
        if ($category->update($data)) {
            if (isset($data['brands'])) {
                $brands = collect($data['brands'])->map(function ($b) {
                    return ['brand_id' => $b];
                });
                $category->categoryBrands()->createMany($brands);
            }
            if (isset($file)) {
                $this->dispatch(new RemoveFileJob($file));
            }
            return success_out($this->getResource($category));
        }
        return error_out(['message' => 'Ошибка при сохранении'], 422, 'Ошибка при сохранении');
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            $this->dispatch(new RemoveFileJob($category->image));
        }
        return success_out($this->getResource($category));
    }

    private function getResource(Category $category): array
    {
        return [
            'id' => $category->id,
            'parent_id' => $category->parent_id ?? '',
            'parent_name' => optional($category->parent)->{'name_ru' . \App::getLocale()},
            'name_uz' => $category->name_uz,
            'name_ru' => $category->name_ru,
            //'is_popular' => $category->is_popular,
            'status' => $category->status,
            'image_url' => $category->image_url,
            'category_brands' => $category->categoryBrands,
            'children' => CategoryResource::collection($category->children)
        ];
    }
}
