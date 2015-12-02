<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        echo "hello";
    }

public function updateProfile(Requests\UpdateStudentProfileRequest $request, $remember_token)
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
                $message= "Student updated successfully";
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
