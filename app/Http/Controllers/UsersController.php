<?php

namespace App\Http\Controllers;
use App\Leaves;
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
}
    public function updateTeacherProfile(Requests\UpdateTeacherProfileRequest $request, $remember_token)
    {
      try {
          $UserData = $request->all();
            $userKeys = array(
                'email',
                'username',
                '_method',
                'password',
                ' is_active',
                ' status_id ',
                ' role_id ',
                ' creator_id ',
                ' remember_token ',
            );
                $UserData = $this->unsetKeys($userKeys, $UserData);
                $systemUser = User::where('remember_token', $remember_token)->first();
                $status = 200;
                $message= "Your Profile has been updated successfully";
                $birthdate = date('Y-m-d', strtotime($request->birthdate));
                $UserData['birthdate'] = $birthdate;
                $UserData['updated_at'] = Carbon::now();
                User::where('id',$systemUser->id)
                      ->update($UserData);
            } catch (\Exception $e) {
                $status = 500;
                $message= "Profile updating failed"  . $e->getMessage();
                }
                $response = [
                'message' => $message ,
                 'status'  => $status
                          ];
        return response($response, $status);
    }

    public function updateStudentProfile(Requests\UpdateStudentProfileRequest $request, $remember_token)
    {
        try {
            $UserData = $request->all();
            $userKeys = array(
                'email',
                'username',
                '_method',
                'password',
                ' is_active',
                ' status_id ',
                ' role_id ',
                ' creator_id ',
                ' remember_token ',
            );
            $UserData = $this->unsetKeys($userKeys, $UserData);
            $systemUser = User::where('remember_token', $remember_token)->first();
            $status = 200;
            $message= "Your Profile has been updated successfully";
            $birthdate = date('Y-m-d', strtotime($request->birthdate));
            $UserData['birthdate'] = $birthdate;
            $UserData['updated_at'] = Carbon::now();
            User::where('id',$systemUser->id)
                ->update($UserData);
        } catch (\Exception $e) {
            $status = 500;
            $message= "Profile updating failed"  . $e->getMessage();
        }
        $response = [
            'message' => $message ,
            'status'  => $status
        ];
        return response($response, $status);
    }

    public function adminUpdateStudentProfile(Requests\AdminUpdateStudentProfileRequest  $request, $remember_token , $id)
     {
        try {
            $UserData = $request->all();
            $userKeys = array(
                'email',
                'username',
                '_method',
                'password',
                ' is_active',
                ' status_id ',
                ' role_id ',
                ' creator_id ',
                ' remember_token ',
            );
            $UserData = $this->unsetKeys($userKeys, $UserData);
            $systemUser = User::where('id', $id)->first();
            $status = 200;
            $message= "Student Profile updated successfully";
            $birthdate = date('Y-m-d', strtotime($request->birthdate));
            $UserData['birthdate'] = $birthdate;
            $UserData['updated_at'] = Carbon::now();
            User::where('id',$systemUser->id)
                ->update($UserData);
        } catch (\Exception $e) {
            $status = 500;
            $message= "Profile updating failed"  . $e->getMessage();
        }
        $response = [
            'message' => $message ,
            'status'  => $status
        ];
        return response($response, $status);
    }

    public function adminUpdateTeacherProfile(Requests\AdminUpdateTeacherProfileRequest  $request, $remember_token,$id)
    {
        try {
            $UserData = $request->all();
            $userKeys = array(
                'email',
                'username',
                '_method',
                'password',
                ' is_active',
                ' status_id ',
                ' role_id ',
                ' creator_id ',
                ' remember_token ',
            );
            $UserData = $this->unsetKeys($userKeys, $UserData);
            $systemUser = User::where('id', $id)->first();
            $status = 200;
            $message= "Teacher Profile updated successfully";
            $birthdate = date('Y-m-d', strtotime($request->birthdate));
            $UserData['birthdate'] = $birthdate;
            $UserData['updated_at'] = Carbon::now();
            User::where('id',$systemUser->id)
                ->update($UserData);
        } catch (\Exception $e) {
            $status = 500;
            $message= "Profile updating failed"  . $e->getMessage();
        }
        $response = [
            'message' => $message ,
            'status'  => $status
        ];
        return response($response, $status);
    }
    public function studentApplyForLeave(Requests\StudentApplyForLeaveRequest $request, $remember_token)
    {
        $data = $request->all();
        $systemUser = User::where('remember_token', $remember_token)->first();
        $status = 200;
        $message= "You have Successfully applied for leave";
        $fromDate = date('Y-m-d', strtotime($request->from_date));
        $toDate = date('Y-m-d', strtotime($request->to_date));
        $UserData['student_id'] = $systemUser->id;
        $UserData['from_date'] = $fromDate;
        $UserData['to_date'] = $toDate;
        $UserData['status'] = 2;//initially set to 2 for pending
        $UserData['created_at'] = Carbon::now();
        $UserData['updated_at'] = Carbon::now();
        if($systemUser->role_id==3)
            {
                $leaveStatus=Leaves::where('student_id',$systemUser->id)
                           ->where('status', '2')->first();
                if($leaveStatus!=null)
                    {
                          if($leaveStatus->status==2){ //if student has already applied for laeve and still not apporoved
                          $status= 406;
                          $message ="You have already applied for leave and it is till not approved";
                      }else
                          {
                              try{
                                  Leaves::create($UserData);;
                              }catch (\Exception $e){
                                  $status= 406;
                                  $message = $e->getMessage();
                              }
                          }
                    }else{
                          try{
                              Leaves::create($UserData);;
                          }catch (\Exception $e){
                              $status= 406;
                              $message = $e->getMessage();
                          }
                      }
        }else{
            $status= 406;
            $message ="You are not authorised for this operation";
        }
        $response = [
            'message' => $message ,
            'status'  => $status
        ];
        return response($response, $status);
    }
}
