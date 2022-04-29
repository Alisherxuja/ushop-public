<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WidgetRequest extends FormRequest
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
            'category_id' => 'nullable|integer|exists:categories,id',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'key' => 'required|string|max:100',
            'order' => 'nullable|integer',
            'items' => 'required|array',
            'items.*.image' => 'required|string',
            'items.*.status' => 'required|integer',
            'items.*.order' => 'required|integer',
        ];

        if ($this->getMethod() === 'PUT') {
            $data['items'] = 'nullable|array';
            $data['items.*.image'] = 'nullable|string';
            $data['items.*.status'] = 'nullable|integer';
            $data['items.*.order'] = 'nullable|integer';
        }

        return $rules;
    }
}
