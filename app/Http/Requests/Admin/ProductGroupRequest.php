<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductGroupRequest extends FormRequest
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
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'measure_id' => 'required|exists:measures,id',
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            'content_uz' => 'nullable|string|max:15000',
            'content_ru' => 'nullable|string|max:15000',
            'description' => 'nullable|string|max:4096',
            'keywords' => 'nullable|string|max:255',
            'features' => 'nullable|array',

            'features.*.feature_id' => 'required|exists:features,id',
            'features.*.value_id' => 'nullable|exists:feature_values,id',
            'features.*.value' => 'nullable|string|max:255'
        ];
    }
}
