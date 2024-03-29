<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title_ru' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'content_ru' => 'required|string',
            'content_uz' => 'required|string',
            'keywords' => 'required|string',
            'description' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|string',
        ];
    }
}
