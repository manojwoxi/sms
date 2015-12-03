<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    public function createClass(Requests\CreateClassRequest $request)
    {
        try{
            $classes = $request->all();
            $status = 200;
            $message = "New classes added successfully";
            $classes['created_at'] = Carbon::now();
            $classes['updated_at'] = Carbon::now();
            $result=Classes::create($classes);
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

    public function updateClass(Requests\CreateClassRequest $request,$id)
    {
        try{
            $classes = $request->all();
            $status = 200;
            $message = "class information updated successfully";
            unset($classes['_method']);
            $classes['created_at'] = Carbon::now();
            $classes['updated_at'] = Carbon::now();
            Classes::where('id', '=', $id)->update($classes);
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

    public function deleteClass(Requests\CreateClassRequest $request,$id)
    {
        try{
            $request->all();
            $status = 200;
            $message = "class information deleted successfully";
            Classes::where('id', '=', $id)->delete();

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
