<?php

namespace App\Domain\Admin\Requests\WebsiteLink;

use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class EmailTemplateRequest
 * @package App\Http\Requests
 */
class WebsiteLinkRequest extends FormRequest implements IFormRequest
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
            'name'         => 'required|min:2',
            'nepali_name'  => 'required|min:2',
            'order'        => 'required|numeric',
            'website_link' => 'required|url',
        ];
    }
}
