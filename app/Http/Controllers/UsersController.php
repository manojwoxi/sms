<?php

namespace App\Http\Controllers;

use App\Role;
use App\Status;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function confirm($confirmation)
    {
        $user = User::where('remember_token', $confirmation)->first();
        if ($user == null) { // no record found
            $status = 200;
            $message= "Sorry!! No User found";
        } else {
            if ($user->is_active) { // already confirmed
                $status = 200;
                $message="Your account already confirmed";
            } else {
                User::where('remember_token', $confirmation)->update(array(
                    'is_active' => 1
                ));
                $status = 200;
                $message="Your account is confirmed, you can now login to your account";
            }
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }


    public function storeStudent($studentData)
    {
        $result = array();
        $result['status'] = true;
        try{
            $result=Student::create($studentData);
        }catch (\Exception $e){
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function storeUser(Requests\CreateUSerRequest $request)
    {
        try {
            $status = 200;
            $message="User Registered Successfully! Please login to continue";
            $userStatus = Status::where('slug', 'pending')->first();
            $userData = $request->all();
            $role = Role::where('id', $userData['role_id'])->first();
            $userData['password'] = bcrypt($request->password);
            $userData['is_active'] = 1;
            $userData['status_id'] = $userStatus->id;
            $userData['role_id'] = $role->id;
            $userData['remember_token'] = csrf_token();
            $userData['updated_at'] = Carbon::now();
            $userData['created_at'] = Carbon::now();
            $studDiv=$userData['div_id'];
            unset($userData['div_id']);
            $userId = DB::table('users')->insertGetId($userData);
            if($userData['role_id']==3){
                $studentData['user_id'] = $userId;
                $studentData['div_id']=$studDiv;
                $studentData['updated_at'] = Carbon::now();
                $studentData['created_at'] = Carbon::now();
                $result = $this->storeStudent($studentData);

            }


        } catch (\Exception $e) {
            $status = 500;
            $message= "Something Went Wrong, User Registration Unsuccessful!" . $e->getMessage();
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }
}
