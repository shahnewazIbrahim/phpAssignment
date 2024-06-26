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

class JobController extends Controller
{

    function CreateJob(Request $request)
    {
        try {
            $user_id = Auth::id();
            $data =  $request->validate([
                'type' => 'required|string|max:50',
                'specialities' => 'required|string|max:50',
                'salary' => 'required',
                'deadline' => '',
                'requirements' => 'required',
                'experience' => 'required',
                'compensations' => 'required',
                'responsibilities' => 'required',
                'location' => 'required',
                'employee_status' => 'required',
            ]);
            // return $request->input('requirements');
            Job::create([
                'type' => $request->input('type'),
                'specialities' => $request->input('specialities'),
                'salary' => $request->input('salary'),
                'deadline' => $request->input('deadline'),
                'requirements' => $request->input('requirements'),
                'experience' => $request->input('experience'),
                'compensations' => $request->input('compensations'),
                'responsibilities' => $request->input('responsibilities'),
                'location' => $request->input('location'),
                'employee_status' => $request->input('employee_status'),
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
            $rows = Job::query()
                ->with('user:id,firstName,lastName')
                ->where('id', $request->input('id'))
                ->first();

            if (!request()->user()->hasRole('Owner')) {
                $rows->where('user_id', $user_id);
            }
            return response()->json(['status' => 'success', 'rows' => $rows]);
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
                ->with('user:id,firstName,lastName')
                ->where('id', $request->input('id'))
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
            $rows = Job::query()
                ->with('user:id,firstName,lastName')
                ->when(in_array('Company',  User::find(Auth::id())->roles->pluck('name')->toArray()), function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function UpdateJob(Request $request)
    {
        // return $request;
        try {
            $user_id = Auth::id();
            $request->validate([
                'type' => 'required|string|max:50',
                'specialities' => 'required|string|max:50',
                'salary' => 'required',
                'deadline' => '',
                'requirements' => 'required',
                'experience' => 'required',
                'compensations' => 'required',
                'responsibilities' => 'required',
                'location' => 'required',
                'employee_status' => 'required',
                "id" => 'required|string',
            ]);

            Job::where('id', $request->input('id'))->where('user_id', $user_id)->update([
                'type' => $request->input('type'),
                'salary' => $request->input('salary'),
                'specialities' => $request->input('specialities'),
                'deadline' => $request->input('deadline'),
                'requirements' => $request->input('requirements'),
                'experience' => $request->input('experience'),
                'compensations' => $request->input('compensations'),
                'responsibilities' => $request->input('responsibilities'),
                'location' => $request->input('location'),
                'employee_status' => $request->input('employee_status'),
            ]);

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function applyJob(Request $request)
    {
        try {
            if ($request->user()->candidate) {
                ApplyJob::create(
                    [
                        'job_id' => $request->id,
                        'user_id' => $request->user()->id,
                    ]
                );
                return response()->json(['status' => 'success', 'message' => "Request Successful"]);
            } else {
                return response()->json(['status' => 'fail', 'message' => "Incomplete Profile"]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
