<?php

namespace App\Domain\Admin\Requests\WasteBusRoutine;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactUsRequest
 * @package App\Domain\Front\Requests
 */
class WasteBusRoutineRequest extends FormRequest implements IFormRequest
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
            "sunday"    => 'nullable|min:4',
            "monday"    => 'nullable|min:4',
            "tuesday"   => 'nullable|min:4',
            "wednesday" => 'nullable|min:4',
            "thursday"  => 'nullable|min:4',
            "friday"    => 'nullable|min:4',
            "saturday"  => 'nullable|min:4',
        ];
    }
}
