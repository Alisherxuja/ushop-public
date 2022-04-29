<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'parent_id' => 'nullable|exists:locations,id',
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            //'has_delivery' => 'required|boolean',
            'status' => 'nullable|integer|in:0,10'
        ];
    }
}
