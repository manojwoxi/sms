<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateStudentProfileRequest extends Request
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
            'fname' => 'required|min:3|max:20',
            'lname' => 'required|min:3|max:20',
            'phone_no' => 'required|min:10|max:12',
            'address' => 'required|min:10|max:255',
            'gender' => 'required|min:1|max:2',
            'birthdate' => 'required|date',
        ];
    }
}
