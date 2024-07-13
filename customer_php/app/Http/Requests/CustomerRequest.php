<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nationality_id' => ['required', 'exists:nationality'],
            'cst_name' => ['required'],
            'cst_dob' => ['required'],
            'cst_phoneNum' => ['required'],
            'cst_email' => ['required', 'email', 'max:254'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
