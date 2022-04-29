<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class HomeWidgetRequest extends FormRequest
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
            'title_ru' => 'nullable|string|max:255',
            'title_uz' => 'nullable|string|max:255',
            'widget_name' => 'required|string|max:255',
            'order' => 'required|integer',
            'category_id' => 'nullable|integer|exists:categories,id',
            'type' => 'required|string|max:255',//products,categories,brands,news,adds
            'items' => 'required|array',
            'is_carousal' => 'nullable|boolean',
            'is_main' => 'nullable|boolean',
            'home_category_id' => 'required_if:is_main,0|exists:categories,id',
            'url' => 'nullable|string',
            'status' => 'nullable|integer'
        ];

        if (request('type') == 'products')
            $rules['items.*'] = 'required|integer|exists:products,id';

        if (request('type') == 'categories')
            $rules['items.*'] = 'required|integer|exists:categories,id';

        if (request('type') == 'brands')
            $rules['items.*'] = 'required|integer|exists:brands,id';

        if (request('type') == 'news')
            $rules['items.*'] = 'required|integer|exists:articles,id';

//        if (request('type') == 'adds')
//            $rules['items.*'] = 'required|integer|exists:adds,id';

        return $rules;
    }
}
