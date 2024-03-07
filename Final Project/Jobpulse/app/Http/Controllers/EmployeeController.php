<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    function EmployeeCreate(Request $request):JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50',
                'mobile' => 'required|string|min:11'
            ]);

            $user_id=Auth::id();
            Employee::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'user_id'=>$user_id
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function EmployeeList(Request $request): JsonResponse
    {
        try {
            $user_id=Auth::id();
            $rows= Employee::where('user_id',$user_id)->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function EmployeeDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $employee_id=$request->input('id');
            $user_id=Auth::id();
            Employee::where('id',$employee_id)->where('user_id',$user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function EmployeeByID(Request $request){
        try {
            $request->validate([
                'id' => 'required|min:1'
            ]);
            $employee_id=$request->input('id');
            $user_id=Auth::id();
            // return 
            $rows= Employee::where('id',$employee_id)->where('user_id',$user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

     function EmployeeUpdate(Request $request){

         try {
             $request->validate([
                 'name' => 'required|string|max:50',
                 'email' => 'required|string|email|max:50',
                 'mobile' => 'required|string|min:11',
                 'id'=>'required|min:1',
             ]);

             $employee_id=$request->input('id');
            //  return
             $user_id=Auth::id();
             Employee::where('id',$employee_id)->where('user_id',$user_id)->update([
                 'name'=>$request->input('name'),
                 'email'=>$request->input('email'),
                 'mobile'=>$request->input('mobile'),
             ]);
             return response()->json(['status' => 'success', 'message' => "Request Successful"]);
         }catch (Exception $e){
             return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
         }
    }

}
