<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodo extends FormRequest
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
            'title' => 'required|max:30',
	    'detail' => 'required|max:100',
        ];
    }
    /*public function messages(){
	    return[
		    'detail.max' => 'A detail is not allowed over 100 character.',
	    ];
    }*/    
}
