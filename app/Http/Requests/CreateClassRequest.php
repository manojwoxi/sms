<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class CreateClassRequest extends Request
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
                        $user = Auth::user();
                        $isOwner = User::where('id', '=', $user->id)->count();
                        if ($isOwner) {
                            return true;
                        } else {
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
                    'name' => 'required|min:5|max:50'];
                break;
            case 'POST':
                return [
                    'name' => 'required|min:5|max:50'];
                break;
            case 'GET':
                return [];
                break;
            default:
                break;
        }
    }
}
