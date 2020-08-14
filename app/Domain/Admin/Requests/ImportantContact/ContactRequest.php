<?php

namespace App\Domain\Admin\Requests\ImportantContact;


use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest implements IFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'important_contact_category_id' => 'required|exists:'.DBTable::IMPORTANT_CONTACT_CATEGORY.',id',
            'image'                         => 'nullable|mimes:jpeg,png,jpg|max:10240',
            'name'                          => 'required|min:2|max:80',
            'email'                         => 'nullable|email',
            'phone'                         => 'nullable|min:3|max:15',
            'fax'                           => 'nullable|min:3|max:15',
        ];
    }
}