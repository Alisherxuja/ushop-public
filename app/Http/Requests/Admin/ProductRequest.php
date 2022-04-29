<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'measure_id' => 'required|exists:measures,id',
            'name_ru' => 'required|string|max:255',
            'name_uz' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'unicode' => 'required|string|unique:products,unicode',
            'price' => 'required|integer',
            'discount' => 'nullable|integer',
            'old_price' => 'nullable|integer',
            'stock' => 'required|integer',
            'info_uz' => 'nullable',
            'info_ru' => 'nullable',
            'status' => 'required|integer|in:10,0',
            'attachments' => 'nullable|array',
            'attachments.*.image' => 'required|string',
            'attachments.*.is_avatar' => 'nullable|boolean'
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['sku'] = 'required|string|unique:products,sku,'.request('product')->id;
            $rules['unicode'] = 'required|string|unique:products,unicode,'.request('product')->id;
        }

        return $rules;
    }
}
