<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreStuffRequest extends Request
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
            'name' => 'required|max:255',
            'job' => 'required|max:255',
            'active' => 'required|max:255',
            'user_id' => 'required|max:255',
        ];
    }
}