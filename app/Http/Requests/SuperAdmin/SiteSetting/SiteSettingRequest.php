<?php

namespace App\Http\Requests\SuperAdmin\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
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
            'email'=>'required',
            'address'=>'required',
            'brochure'=>'sometimes|mimes:pdf,jpg|max:500000',
        ];
    }
}
