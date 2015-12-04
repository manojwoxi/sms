<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class AdminUpdateStudentProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data  = $this->request->all();
        $token = $this->route('remember_token');
        $id   = $this->route('id');
        $userId = User::where('id',$id)->first();
        $userToken = User::where('remember_token',$token)->first();
        if(($userToken->remember_token!=null)&&$userId->id!=null){
            return true;
        }else{
            return false;
        }
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
