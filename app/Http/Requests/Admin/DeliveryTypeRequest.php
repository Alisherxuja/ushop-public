<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryTypeRequest extends FormRequest
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
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            'description_ru' => 'nullable|string',
            'description_uz' => 'nullable|string',
            'short_info_ru' => 'nullable|string',
            'short_info_uz' => 'nullable|string',
            //'price' => 'nullable|integer',
            //'is_default' => 'nullable|boolean',
            'status' => 'required|integer|in:10,0',
        ];
    }
}
