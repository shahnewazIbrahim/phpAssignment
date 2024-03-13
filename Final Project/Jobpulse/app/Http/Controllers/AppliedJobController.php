<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AppliedJobController extends Controller
{

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

    function JobDetails(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);
            $rows = Job::query()
                ->with('user:id,firstName')
                ->where('id' , $request->input('id'))
                ->first();
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
}
