<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\UserToTest;

class MailPdfEditFormRequest extends FormRequest
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

		$usertotest =UserToTest::where('user_id', auth()->user()->id)->where('feedback_status','0')->first();
		if ($usertotest->test_id==7) /* M3 has different rules. only needs one questions/answers per pair of examiners (main and substitute) */
		{
				//moved validation to public/eduread/js/function.js !!!
				$rules = [
					'test_id'                  => 'required|numeric',
					'semester_session'         =>'required',
					'examinerlist'             =>'required',
					'questions'                =>'required',
					'answers'                  =>'required',
					//'questions.*'              =>'required|min:10',
					//'answers.*'                =>'sometimes|min:10',	
				];
		} else {
			$rules = [
					'test_id'                  => 'required|numeric',
					'semester_session'         =>'required',
					'examinerlist'             =>'required',
					'questions'                =>'required',
					'answers'                  =>'required',
					'questions.*'              =>'required|min:10',
					'answers.*'                =>'required|min:10',	
				];
		}
		//return $v;
		return $rules;
    }

    public function messages()
    {
        return [
            'test_id.required'=> 'The test field is required.',
            'examinerlist.required'=> 'The examiner(s) field is required.'
        ];
    }

}
