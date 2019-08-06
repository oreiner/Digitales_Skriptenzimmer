<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailPdfFormRequest extends FormRequest
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
            'test_id'                    => 'required|numeric',
            'examinerlist'                =>'required',
        ];
    }

    public function messages()
    {
        return [
            'test_id.required'=> 'The test field is required.',
            'examinerlist.required'=> 'The examiner(s) field is required.'
        ];
    }
}
