<?php

namespace App\Domain\Front\Requests;

use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class FinderNotificationMarkAllAsRead
 * @package App\Domain\Front\Requests
 */
class FinderNotificationMarkAllAsRead extends FormRequest implements IFormRequest
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
        return [];
    }
}
