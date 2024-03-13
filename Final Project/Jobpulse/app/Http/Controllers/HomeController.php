<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function getAboutSetting()
    {
        $data = [];
        $data['about'] = AboutSetting::first();
        $data['company'] = User::where('type', 'Company')->get();
        return $data;
    }
    function getHomepage(Request $request)
    {
        $data = [];
        $data['company'] = User::where('type', 'Company')->get();
        $data['job'] = Job::with('applyJobs')->get();
        $data['apply_job_ids'] = ApplyJob::where('user_id', Auth::id())->pluck('job_id')->toArray();
        return $data;
    }
}
