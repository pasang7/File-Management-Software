<?php

namespace App\Http\Requests\SuperAdmin\File;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'filename' => 'sometimes|mimes:jpeg,jpg,png,gif,doc,docx,pdf,csv,xls,xlsx,pptx,zip|max:100000',
            'status'=>'required',
        ];
    }
}
