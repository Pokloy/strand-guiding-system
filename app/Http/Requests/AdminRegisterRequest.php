<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'input_firstname' => [
                'required'
            ],
            'input_middlename' => [
                'required'
            ],
            'input_lastname' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'input_firstname.required' => 'First name is required',
            'input_middlename.required' => 'Middle name is required',
            'input_lastname.required' => 'Last name is required'
        ];
    }
}
