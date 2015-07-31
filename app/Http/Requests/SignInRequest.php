<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SignInRequest extends Request
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
            'username' => [
                'required',
                'regex:/^\d{9}$/'
            ],
            'password' => 'required',
            'termsOfService' => 'required|accepted',
        ];
    }
}