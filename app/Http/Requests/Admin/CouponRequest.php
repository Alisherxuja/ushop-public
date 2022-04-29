<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_amount' => 'required|integer',
            'coupon_percent' => 'required|integer',
            'min_amount' => 'nullable|integer',
            'max_amount' => 'nullable|integer',
            'left_amount' => 'nullable|integer',
            'begin_at' => 'required|string',
            'finish_at' => 'required|string',
            'status' => 'required|integer',
        ];
    }
}
