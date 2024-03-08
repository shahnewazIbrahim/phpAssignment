<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class JobController extends Controller
{

    function CreateJob(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                'type' => 'required|string|max:50',
                'specialities' => 'required|string|max:50',
                'amount' => 'required',
                'deadline' => '',
            ]);
            // return $request;
            Job::create([
                'type' => $request->input('type'),
                'specialities' => $request->input('specialities'),
                'deadline' => $request->input('deadline'),
                'user_id' => $user_id
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function DeleteJob(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                "id" => 'required|string',
            ]);
            Job::where('id', $request->input('id'))->where('user_id', $user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function JobByID(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);
            $rows = Job::where('id', $request->input('id'))->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function JobList(Request $request)
    {
        try {
            $user_id = Auth::id();
            $rows = Job::with('user:id,firstName')->get();
            // return in_array('Owner',  User::find(Auth::id())->roles->pluck('name')->toArray());
            if (in_array('Owner',  User::find(Auth::id())->roles->pluck('name')->toArray())) {
                $rows->where('user_id', $user_id);
            }
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function UpdateJob(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                'type' => 'required|string|max:50',
                'specialities' => 'required|string|max:50',
                'amount' => 'required',
                'deadline' => '',
                "id" => 'required|string',
            ]);

            Job::where('id', $request->input('id'))->where('user_id', $user_id)->update([
                'type' => $request->input('type'),
                'amount' => $request->input('amount'),
                'specialities' => $request->input('specialities'),
                'deadline' => $request->input('deadline'),
            ]);

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
