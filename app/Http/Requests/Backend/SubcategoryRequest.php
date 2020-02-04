<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories',
            'slug' => 'required|unique:categories',
            'rank' => 'required|unique:categories',
        ];
    }
    function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
        ];
    }
}
