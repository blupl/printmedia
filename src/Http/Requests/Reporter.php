<?php namespace Blupl\PrintMedia\Http\Requests;

use App\Http\Requests\Request;

class Reporter extends Request {

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
//            "name" => "required",
//            "personal_id" => "required",
//            "date_of_birth" => "required",
//            "mobile" => "required",
//            "email" => "required",
		];
	}

}
