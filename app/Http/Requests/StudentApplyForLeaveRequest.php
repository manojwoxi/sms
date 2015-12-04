<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class StudentApplyForLeaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data = $this->request->all();
        $token = $this->route('remember_token');
        $userToken = User::where('remember_token',$token)->first();
        if($userToken!=null){
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
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ];
    }
}
