<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;

class deleteMarksheet extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $token = $this->route('remember_token');
        $userToken = User::where('remember_token',$token)->first();
        if($userToken!=null && $userToken->id!=3){
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
            //
        ];
    }
}
