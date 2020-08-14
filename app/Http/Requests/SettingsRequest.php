<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class SettingsRequest
 * @package App\Http\Requests
 */
class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @param Request $request
     * @return array
     * @internal param Request $request
     */
    public function rules(Request $request)
    {
        return [
            'title'        => 'required|min:2|max:50|unique:settings,title,'.$request->segment(3),
            'content'      => 'required_without:settingImage',
            'settingImage' => 'required_without:content',
        ];
    }
}
