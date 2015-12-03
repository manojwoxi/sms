<?php

namespace App\Http\Controllers;

use App\Marksheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
