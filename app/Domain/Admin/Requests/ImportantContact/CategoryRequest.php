<?php

namespace App\Domain\Admin\Requests\ImportantContact;


use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest implements IFormRequest
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
            'name' => 'required|min:3|max:80|unique:'.DBTable::IMPORTANT_CONTACT_CATEGORY.',name,'.request()->segment(3).',id,deleted_at,NULL',
        ];
    }
}