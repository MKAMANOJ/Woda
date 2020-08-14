<?php

namespace App\Domain\Admin\Requests\Gallery;


use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GalleryImageRequest extends FormRequest implements IFormRequest
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
        $imageRule    = request()->segment(3) ? 'nullable' : 'required';
        $categoryRule = request('direct-to-gallery') ? '' : 'required|exists:'.DBTable::GALLERY_CATEGORY.',id';

        return [
            'gallery_category_id' => $categoryRule,
            'image'               => $imageRule.'|mimes:jpeg,png,jpg,gif|max:10240',
            'title'               => 'nullable|min:2|max:80',
        ];
    }
}