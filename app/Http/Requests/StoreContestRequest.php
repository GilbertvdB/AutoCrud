<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreContestRequest extends Request
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
            'title' => 'required|max:255',
            'date' => 'required|max:255',
            'content' => 'required|max:255',
            'image' => 'required',
            'blok1-title' => 'required|max:255',
            'blok1-content' => 'required|max:255',
            'blok1-image' => 'required',
            'blok2-title' => 'nullable|max:255',
            'blok2-content' => 'nullable|max:255',
            'blok2-image' => 'nullable|max:255',
        ];
    }
}