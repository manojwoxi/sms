<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function createSubject(Requests\SubjectRequest $request, $remember_token )
    {
        try{
            $Subject= $request->all();
            $status = 200;
            $message = "New Subject added successfully";
            $Subject['created_at'] = Carbon::now();
            $Subject['updated_at'] = Carbon::now();
            Subject::create($Subject);
        }
        catch (\Exception $e) {
            $status = 500;
            $message = "Something went wrong : " . $e->getMessage();
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }

    public function updateSubject(Requests\SubjectRequest $request,$remember_token,$id)
    {
        try{
            $data= $request->all();
            $status = 200;
            $message = "Subject information updated successfully";
            unset($data['_method']);
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            Subject::where('id', '=', $id)->update($data);
        }
        catch (\Exception $e) {
            $status = 500;
            $message = "Something went wrong : " . $e->getMessage();
        }
        $response = [
            "message" => $message
        ];
        return response($response, $status);
    }

    public function deleteSubject(Requests\SubjectRequest $request,$remember_token,$id)
    {
        try{
            $request->all();
            $status = 200;
            $message = "Subject deleted successfully";
            Subject::where('id', '=', $id)->delete();
        }
        catch (\Exception $e) {
            $status = 500;
            $message = "Something went wrong : " . $e->getMessage();
        }
        $response = [
            "message" => $message,
            "status" =>$status
        ];
        return response($response, $status);
    }
}
