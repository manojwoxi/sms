<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Subject;
use App\User;

class SubjectRequest extends Request
{
    public function authorize()
    {
            switch ($this->method()) {
                case 'GET':
                    $token = $this->route('remember_token');
                    $subjectId = $this->route('id');
                    $id = Subject::where('id',$subjectId)->first();
                    $userToken = User::where('remember_token',$token)->first();
                    if($userToken!=null && $userToken->role_id == 2 && $id != null){
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 'POST':
                    $data = $this->request->all();
                    $token = $this->route('remember_token');
                    $userToken = User::where('remember_token',$token)->first();
                    if($userToken!=null && $userToken->role_id==2){//checking that is it a teacher or not
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 'PUT':
                    $data = $this->request->all();
                    $token = $this->route('remember_token');
                    $class=$data['class_id'];
                    $class_id = Subject::where('class_id',$class)->first();
                    $userToken = User::where('remember_token',$token)->first();
                    if($userToken!=null && $userToken->role_id==2 && $class_id!=null){//checking that is it a teacher or not
                        return true;
                    }else{
                        return false;
                    }
                    break;
                default:
                    return false;
                    break;
           }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
                return [
                    'class_id'=>'required|min:1|max:2',
                    'name' => 'required|min:3|max:50'];
                break;
            case 'POST':
                return [
                    'class_id'=>'required|min:1|max:2',
                    'name' => 'required|min:3|max:50'];
                break;
            case 'GET':
                return [];
                break;
            default:
                break;
        }
    }
}
