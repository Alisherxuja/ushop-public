<?php

namespace App\Http\Requests\Admin;

use App\Models\Base\Info\Feature;
use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Boolean;

class FeatureRequest extends FormRequest
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
        $rules = [
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:features,id',
            'unit' => 'nullable|string|max:30',
            'colorable' => 'nullable|boolean',
            'type' => 'required_with:parent_id|nullable|string|max:50|in:'.Feature::typeListForValidation(),
            'filter_type' => 'required_with:parent_id|nullable|string|max:50|in:'.Feature::typeListForValidation(),
            'order' => 'nullable|numeric|max:99|min:0',
            'status' => 'nullable|integer|in:10,0',
            'is_filter' => 'required|boolean',
            'is_main' => 'required|boolean',
            'is_variant' => 'required|boolean',
            'is_required' => 'required|boolean',

            'feature_values' => 'required_if:type,radio,dropdown,checkbox|array',
            'feature_values.*.value_ru' => 'required_if:type,radio,dropdown,checkbox|string|max:255',
            'feature_values.*.value_uz' => 'required_if:type,radio,dropdown,checkbox|string|max:255',
            'feature_values.*.color' => 'nullable|string|max:255',
        ];

        if ($this->getMethod() == 'POST') {
            $rules['categories'] = 'required|array';
            $rules['categories.*'] = 'required|integer|exists:categories,id';
        } else {
            $rules['category_id'] = 'required|integer|exists:categories,id';
        }

        return $rules;
    }
}
