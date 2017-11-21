<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check() && \Auth::user()->isRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'short_name' => 'required',
            'full_name' => 'required',
            'tags' => 'array',
            'display_author' => 'required|boolean',
            'is_private' => 'required|boolean',
            'text' => 'required'
        ];
    }
}
