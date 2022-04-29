<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|max:512',
            'is_popular' => 'nullable|boolean',
            'status' => 'nullable|integer|in:0,10',
            'categories' => 'nullable|array',
            'categories.*.category_id' => 'nullable|integer|exists:categories,id'
        ];
    }
}
