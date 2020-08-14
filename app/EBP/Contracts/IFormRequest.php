<?php

namespace App\EBP\Contracts;

/**
 * Interface IFormRequest
 * @package App\EBP\Contracts
 */
interface IFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool;

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array;
}
