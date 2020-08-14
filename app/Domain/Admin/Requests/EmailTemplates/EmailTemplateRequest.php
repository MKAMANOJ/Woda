<?php

namespace App\Domain\Admin\Requests\EmailTemplates;

use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class EmailTemplateRequest
 * @package App\Http\Requests
 */
class EmailTemplateRequest extends FormRequest implements IFormRequest
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
            'title'   => 'required|max:210',
            'slug'    => 'required|unique:'.DBTable::EMAIL_TEMPLATES.',slug,'.request()->segment(3),
            'subject' => 'required|min:3',
            'content' => 'required',
        ];
    }
}
