<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'image' => 'mimes:jpeg,jpg,png,gif|required',
            'title' => 'required|max:255',
            'about' => 'required|max:512',
            'price' => 'required|numeric',
            'category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => ':attribute je povinný údaj!',
            'title.required' => ':attribute je povinný údaj!',
            'about.required' => ':attribute je povinný údaj!',
            'price.required' => ':attribute je povinný údaj!',
            'category.required' => ':attribute je povinný údaj!',
            'title.max' => ':attribute nesmie obsahovať viac ako 255 znakov!',
            'about.max' => ':attribute nesmie obsahovať viac ako 512 znakov!',
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
            'image' => 'Obrázok',
            'title' => 'Názov',
            'about' => 'Popis',
            'price' => 'Cena',
            'category' => 'Kategória',
        ];
    }
}
