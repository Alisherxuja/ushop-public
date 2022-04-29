<?php

namespace App\Services\Admin;

use App\Models\Base\Products\Product;
use App\Models\Base\Products\VwProduct;
use Illuminate\Http\Request;

class ProductService
{
    public function searchProduct(Request $request)
    {
        return VwProduct::query()
            ->select(['vw_products.*'])
            ->when($request->name, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name_ru', 'ilike', '%' . $request->name . '%')
                        ->orWhere('name_uz', 'ilike', '%' . $request->name . '%');
                });
            })
            ->when($request->category, function ($query) use ($request) {
                if (!is_numeric($request->category)) {
                    $query->where('category_name_uz', 'ilike', '%' . $request->category . '%')
                        ->orWhere('category_name_ru', 'ilike', '%' . $request->category . '%');
                } else {
                    $query->where('category_id', $request->category);
                }
            })
            ->when($request->brand, function ($query) use ($request) {
                if (!is_numeric($request->brand)) {
                    $query->where('brand_name', 'ilike', '%' . $request->brand . '%');
                } else {
                    $query->where('brand_id', $request->brand);
                }
            })
            ->when($request->measure, function ($query) use ($request) {
                if (!is_numeric($request->measure)) {
                    $query->where('measure_name_uz', 'ilike', '%' . $request->measure . '%')
                        ->orWhere('measure_name_ru', 'ilike', '%' . $request->measure . '%');
                } else {
                    $query->where('measure_id', $request->measure);
                }
            })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderByDesc('vw_products.id');
    }

    public function create($data)
    {
        $product = new Product();
        $product->fill($data);
        if ($product->save()) {
            $product->productAttachments()->createMany($data['attachments']);
            return $product;
        }
        return null;
    }

    public function update($data, Product $product)
    {
        if (isset($data['info_uz']) && !empty($data['info_uz'])) {
            $data['info_uz'] = json_encode($data['info_uz']);
        }
        if (isset($data['info_ru']) && !empty($data['info_ru'])) {
            $data['info_ru'] = json_encode($data['info_ru']);
        }
        if ($product->update($data)) {
            $product->productAttachments()->delete();
            $product->productAttachments()->createMany($data['attachments']);
            return $product;
        }
        return null;
    }

    public function addAttachments($data, Product $product)
    {
        if ($product->productAttachments()->createMany($data)) {
            return true;
        }
        return false;
    }
}