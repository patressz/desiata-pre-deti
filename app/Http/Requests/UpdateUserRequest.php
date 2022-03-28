<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user),
            ],
            'role' => 'numeric',
            'credit' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute je povinný údaj!',
            'email.required' => ':attribute je povinný údaj!',
            'role.required' => ':attribute je povinný údaj!',
            'credit.required' => ':attribute je povinný údaj!',
            'name.max' => ':attribute nesmie obsahovať viac ako 255 znakov!',
            'email.max' => ':attribute nesmie obsahovať viac ako 255 znakov!',
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
            'name' => 'Meno',
            'email' => 'E-mail',
            'role' => 'Rola',
            'credit' => 'Kredit',
        ];
    }
}
