<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyListRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cst_id' => ['required', 'exists:customer'],
            'fl_relation' => ['required'],
            'fl_name' => ['required'],
            'fl_dob' => ['required', 'date'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
