<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'input_fname' => [
                'required'
            ],
            'input_lname' => [
                'required'
            ],
            'input_email' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'input_fname.required' => 'First Name is required',
            'input_lname.required' => 'Last Name is required',
            'input_email.required' => 'Email Address is required'
        ];
    }
}
