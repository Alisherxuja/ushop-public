<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'parent_id' => 'nullable|exists:categories,id',
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            'file' => 'nullable|image|max:512',
            //'is_popular' => 'nullable|boolean',
            'status' => 'required|integer|in:10,0',
            'brands' => 'nullable|array',
            'brands.*' => 'nullable|exists:brands,id'
        ];
    }
}
