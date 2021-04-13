<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // no rules for auth...
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
            'first_name' => "string|max:30|required",
            'last_name' => "string|max:30|required",
            'email' => 'email|max:100|required',
            'opt' => 'boolean'
        ];
    }
}
