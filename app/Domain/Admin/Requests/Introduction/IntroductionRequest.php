<?php

namespace App\Domain\Admin\Requests\Introduction;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactUsRequest
 * @package App\Domain\Front\Requests
 */
class IntroductionRequest extends FormRequest implements IFormRequest
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
            "content" => 'required|min:5',
        ];
    }
}
