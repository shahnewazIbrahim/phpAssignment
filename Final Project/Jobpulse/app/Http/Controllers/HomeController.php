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
        $jobs = Job::with([
            'applyJobs',
            'user:id,firstName,lastName',
            'user.plugins:id,name,slug,active,user_id'
        ])->get();

        $data['job'] = $jobs
            ->map(function ($job) {
                $job->is_featured = (bool) optional($job->user)->hasActivePlugin('featured_jobs');
                return $job;
            })
            ->sortByDesc('is_featured')
            ->values();
        $data['apply_job_ids'] = ApplyJob::where('user_id', Auth::id())->pluck('job_id')->toArray();
        return $data;
    }
}
