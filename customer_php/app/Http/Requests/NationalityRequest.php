<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nationality_name' => ['required'],
            'nationality_code' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
