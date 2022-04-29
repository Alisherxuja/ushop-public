<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'is_main' => 'required|boolean',
            'url' => 'required|string',
            'status' => 'required|in:10,0',
            'file' => 'required|image|max:512',
//            'file' => 'required|image|max:512|dimensions:min_width=1070,min_height=240',
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['file'] = 'nullable|image|max:512';
        }
        return $rules;
    }
}
