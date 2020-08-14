<?php

namespace App\Domain\Front\Requests;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class ContactUsRequest
 * @package App\Domain\Front\Requests
 */
class ContactUsRequest extends FormRequest implements IFormRequest
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
            "name"       => 'required|max:50|min:2',
            "contact_no" => 'required|max:15|min:7',
            "email"      => 'required|email',
            "comment"    => 'required|max:1500|min:5',
        ];
    }
}
