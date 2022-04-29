<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'old_price' => 'nullable|integer',
            'ball' => 'nullable|integer',
            'stock' => 'required|integer',
            'value_id' => 'nullable|integer',
            'supplier_store_id' => 'required|integer|exists:supplier_stores,id',

            'variants' => 'nullable|array',
            'variants.*.value_id' => 'required|exists:feature_values,id',
            'variants.*.unicode' => 'required|string',
            'variants.*.price' => 'required|integer',
            'variants.*.stock' => 'required|integer',
            'variants.*.discount' => 'nullable|integer',
            'variants.*.old_price' => 'nullable|integer',
            'variants.*.id' => 'nullable|integer',
        ];
    }
}
