<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function getAboutSetting()
    {
        return AboutSetting::first();
    }
    function getHomepage()
    {
        $data = [];
        $data['company'] = User::where('type', 'Company')->get();
        $data['job'] = Job::get();
        return $data;
    }
}
