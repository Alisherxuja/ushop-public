<?php


namespace App\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|string|unique:users,email',
            'role_name' => 'required|string|exists:roles,name',
        ];

        if ($this->getMethod() == 'POST') {
            $rules['password'] = 'required|string|min:6|max:50';
            //$rules['password_confirm'] = 'required|string|min:6|max:50|same:password';
        }
        return $rules;
    }
}
