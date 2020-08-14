<?php

namespace App\Domain\Front\Requests;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ChangePassword
 * @package App\Http\Requests
 */
class ChangePassword extends FormRequest implements IFormRequest
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
        return [
            'password'         => 'required|min:6',
            'password_confirmation' => 'same:password',
            'current_password' => 'required|min:6|old_password:'.auth()->user()->password,
        ];
    }
}
