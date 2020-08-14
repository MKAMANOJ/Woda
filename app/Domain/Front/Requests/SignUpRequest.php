<?php

namespace App\Domain\Front\Requests;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignUpRequest
 * @package App\Domain\Front\Requests
 */
class SignUpRequest extends FormRequest implements IFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name'                 => 'required|max:50',
            'last_name'                  => 'required|max:50',
            'tmp_sign_up.company_name'   => 'required|max:50',
            'email'                      => 'required|email|max:50|unique:users,email,NULL,id,deleted_at,NULL',
            'tmp_sign_up.contact_number' => 'required|max:15|regex:/^\+?\d[0-9-]{6,15}/',
            'agreement'                  => 'required',
            'password'                   => 'required|max:35|min:6',
            'confirm_password'           => 'same:password',
        ];
        if (request()->segment(1) == 'filler') {
            $rules['tmp_sign_up.location'] = 'required|max:100';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'tmp_sign_up.company_name'   => 'company name',
            'tmp_sign_up.contact_number' => 'contact number',
            'tmp_sign_up.location'       => 'location',
        ];
    }

    public function messages()
    {
        $message =  [
            'agreement.required' => 'Please click on checkbox to accept our Terms & Condition and Privacy Policy.'
        ];

        return $message;
    }
}
