<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourierRequest extends FormRequest
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
            'phone' => 'required|integer',
            'car_number' => 'nullable|string|max:50',
            'car_type' => 'nullable|string|max:50',
            'car_model' => 'nullable|string|max:50',
            'status' => 'required|integer|in:0,10',
        ];
    }
}
