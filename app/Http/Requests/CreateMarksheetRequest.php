<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class CreateMarksheetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!isset($this->uid) && $this->uid==null){
            switch ($this->method()) {
                case 'GET':
                    $data = $this->request->all();
                    $token = $this->route('remember_token');
                    $userToken = User::where('remember_token',$token)->first();
                    if($userToken!=null && $userToken->role_id == 3){
                        return true;
                    }else{
                        return false;
                    }
                    break;
                case 'POST':
                    $user = Auth::user();
                    $isOwner = User::where('id', '=', $user->id)->count();
                    if ($isOwner) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                case 'PUT':
                    $user = Auth::user();
                    $isOwner = User::where('id', '=', $user->id)->count();
                    if ($isOwner) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                default:
                    return false;
                    break;
            }
        }
        return true;
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
                    'stud_id' => 'required|integer',
                    'teacher_id' => 'required|integer',
                    'exam_id' => 'required|integer',
                    'subject_id' => 'required|integer',
                    'marks' => 'required|integer'
                   ];
                break;
            case 'POST':
                return [
                    'stud_id' => 'required|integer',
                    'teacher_id' => 'required|integer',
                    'exam_id' => 'required|integer',
                    'subject_id' => 'required|integer',
                    'marks' => 'required|integer'
                ];
                break;
            case 'GET':
                return [];
                break;
            default:
                break;
        }
    }
}
