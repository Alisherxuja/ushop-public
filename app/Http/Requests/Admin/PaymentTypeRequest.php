<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTypeRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'file' => 'required|image|max:512',
            //'is_default' => 'nullable|boolean',
            'status' => 'required|integer|in:10,0',
        ];
        if ($this->getMethod() == 'PUT') {
            $rules['file'] = 'nullable|image|max:512';
        }
        return $rules;
    }
}
