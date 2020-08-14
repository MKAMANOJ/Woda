<?php

namespace App\Domain\Admin\Requests\File;


use App\Domain\Admin\Services\File\UploadedFileService;
use App\EBP\Constants\DBTable;
use App\EBP\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UploadedFileRequest extends FormRequest implements IFormRequest
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
        $fileRule    = request('upload') ? (request()->segment(3) ? 'nullable' : 'required') : 'nullable';
        $contentRule = request('write') ? 'required' : 'nullable';

        return [
            'order'         => 'required|numeric',
            'uploaded_file' => $fileRule.'|mimes:jpeg,png,jpg,gif,pdf|max:10240',
            'content'       => $contentRule,
            'title'         => 'required|min:2|max:100',
            'upload'        => 'required_without:write',
            'write'         => 'required_without:upload',
        ];
    }

    /**
     * Return custom validation message.
     */
    public function messages()
    {
        return [
            'upload.required_without' => 'You must tick one of these two',
            'write.required_without'  => 'You must tick one of these two',
        ];
    }
}
