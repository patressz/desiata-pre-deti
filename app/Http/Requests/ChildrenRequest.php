<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildrenRequest extends FormRequest
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
            'name' => 'required|max:60',
            'class' => 'required|max:60',
            'school' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute je povinný údaj!',
            'class.required' => ':attribute je povinný údaj!',
            'address.required' => ':attribute je povinný údaj!',
            'school.required' => ':attribute je povinný údaj!',
            'name.max' => ':attribute nesmie obsahovať viac ako 60 znakov!',
            'class.max' => ':attribute nesmie obsahovať viac ako 60 znakov!',
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
            'name' => 'Meno a priezvisko',
            'class' => 'Trieda',
            'school' => 'Škola',
        ];
    }
}
