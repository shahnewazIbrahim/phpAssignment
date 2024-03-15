<?php

namespace App\Http\Controllers;

use App\Mail\SendSuccessMessage;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AppliedJobController extends Controller
{

    function DeleteAppliedJob(Request $request)
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

    function AppliedJobList(Request $request)
    {
        try {
            $user_id = Auth::id();
            $rows = ApplyJob::query()
                ->with('applicant:id,firstName,lastName', 'job:id,type,user_id', 'job.user:id,firstName,lastName')
                ->when(in_array('Candidate',  User::find(Auth::id())->roles->pluck('name')->toArray()), function ($q) {
                    $q->where('user_id', Auth::id());
                })
                ->when(in_array('Company',  User::find(Auth::id())->roles->pluck('name')->toArray()), function ($q) {
                    $q->whereHas('job', function ($query) {
                        $query->where('user_id', Auth::id());
                    });
                })
                ->get();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function AcceptAppliedJob(Request $request)
    {
        try {
            $user_id = Auth::id();
            // return
            $applied_job = ApplyJob::query()
                ->whereHas('job', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->where('id', $request->id)
                ->first();

            $rows = $applied_job 
                ->update([
                    'accept' => 1
                ]);
            // return in_array('Owner',  User::find(Auth::id())->roles->pluck('name')->toArray());
            $email = Auth::user()->email;
            $message = "Your application has been accepted. Please wait a later for confirmation.";

            $count = User::where('email', '=', $email)->count();

            if ($count == 1) {
                Mail::to($email)->send(new SendSuccessMessage($message));
                return response()->json(['status' => 'success', 'message' => 'Your request accepted.']);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Invalid Email Address'
                ]);
            }
            return response()->json(['status' => 'success', 'message' => 'Request Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
