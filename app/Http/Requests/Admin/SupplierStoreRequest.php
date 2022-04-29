<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'location_id' => 'required|exists:locations,id',
            'address_ru' => 'required|string|max:255',
            'address_uz' => 'required|string|max:255',
            'phone' => 'required|integer',
            'second_phone' => 'nullable|integer',
            'coordinates' => 'required|json',
        ];
    }
}
