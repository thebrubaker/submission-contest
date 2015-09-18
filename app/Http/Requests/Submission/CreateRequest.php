<?php

namespace App\Http\Requests\Submissions;

use App\Http\Requests\Request;

class CreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'caption' => 'required',
            'location' => 'required',
            'image' => 'required|max:10000|mimes:jpg,jpeg,png,bmp',
        ];
    }
}
