<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|different:password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => ':attribute je povinný údaj!',
            'new_password.required' => ':attribute je povinný údaj!',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'old_password' => 'Súčasné heslo',
            'new_password' => 'Nové heslo',
        ];
    }
}
