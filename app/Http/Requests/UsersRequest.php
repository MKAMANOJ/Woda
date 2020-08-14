<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        $rules = [
            'email'                 => 'required|string|email|max:255|unique:users',
            'name'                  => 'required|string|max:255',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
        if (request()->method() != "POST") {
            $rules['email']                 = '';
            $rules['password']              = (request('password') == null) ? '' : 'min:6|confirmed';
            $rules['password_confirmation'] = (request('password_confirmation') == null) ? '' : 'min:6';
        }

        return $rules;
    }
}
