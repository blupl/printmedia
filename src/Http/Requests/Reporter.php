<?php namespace Blupl\PrintMedia\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

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
//        $reporters = Input::get('reporter');
//        foreach($reporters as $i=>$reporter) {
//            $rules['reporter['.$i.'][name]'] = 'required';
//            $rules['reporter['.$i.'][personal_id]'] = 'required';
//            $rules['reporter['.$i.'][gender]'] = 'required';
//            $rules['reporter['.$i.'][date_of_birth]'] = 'required';
//            $rules['reporter['.$i.'][mobile]'] = 'required';
//            $rules['reporter['.$i.'][email]'] = 'required';
//            $rules['reporter['.$i.'][role]'] = 'required';
//            $rules['reporter['.$i.'][work_station]'] = 'required';
//            $rules['file'.$i] = 'required';
//            $rules['reporter['.$i.'][card_collection_point]'] = 'required';
//
//        }

        $input = Input::all();

        $rules = [
            'reporter' => 'array|min:1',
        ];

        if (isset($input['reporter']) && is_array($input['reporter']))
        {
            foreach ($input['reporter'] as $Key => $reporter)
            {
                $reporter = 'reporter.' . $Key;
                $rules[$reporter . '.name']       = 'required';
                $rules[$reporter . '.personal_id']        = 'required';
                $rules[$reporter . '.gender'] = 'required';
                $rules[$reporter . '.date_of_birth'] = 'required';
                $rules[$reporter . '.mobile'] = 'required';
                $rules[$reporter . '.email'] = 'required';
                $rules[$reporter . '.role'] = 'required';
                $rules[$reporter . '.work_station'] = 'required';
                $rules[$reporter . '.card_collection_point'] = 'required';
            }
        }



        return $rules;
	}

}
