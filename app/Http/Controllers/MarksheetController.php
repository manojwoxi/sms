<?php

namespace App\Http\Controllers;

use App\Marksheet;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Leaves;
use App\Role;
use App\Status;
use App\Student;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\DB;

class MarksheetController extends Controller
{
    public function createMarksheet(Requests\CreateMarksheetRequest $request){
        try{
            $marks = $request->all();
            $status = 200;
            $message = "marks added successfully";
            $classes['created_at'] = Carbon::now();
            $classes['updated_at'] = Carbon::now();

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
    public function updateMarksheet(Requests\CreateMarksheetRequest $request,$id)
    {
        try{
            $marks = $request->all();
            $status = 200;
            $message = "marksheet information updated successfully";
            unset($marks['_method']);
            $classes['created_at'] = Carbon::now();
            $classes['updated_at'] = Carbon::now();
            Marksheet::where('id', '=', $id)->update($marks);
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

    public function viewMarksheet(Requests\CreateMarksheetRequest $request,$remember_token)
    {
        $systemUser =User::where('remember_token', $remember_token)->first();
        $student =Student::where('user_id',$systemUser->id)->first();
        $markSheet=Marksheet::where('stud_id',$student->id)->get();
        $status = 200;
        $message="Your marks are as follows :";
        $response = [
            "message" => $message,
            "marksheet"=> $markSheet,
        ];
        return response($response, $status);
    }

    public function deleteMarksheet(Requests\deleteMarksheet $request,$remember_token, $id )
    {
        try{
            $request->all();
            $student =Student::where('id',$id)->first();
           if($student==null){
               $message="No student found";
               $status=406;
           }else{
               $result= Marksheet::where('stud_id', '=',$student->id)->get();
               if($result->isEmpty()){
                   $message="No marksheet found for this student to delete";
                   $status=406;
               }else{
                      $status = 200;
                       $message = "Marksheet information deleted successfully";
                       Marksheet::where('stud_id', '=',$student ->id)->delete();
                   }
               }
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

}
