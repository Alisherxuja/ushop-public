<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'location_id' => 'nullable|integer|exists:locations,id',
            'title_ru' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'content_ru' => 'required|string',
            'content_uz' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx'
        ];
    }
}
