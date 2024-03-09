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
        $data = [];
        $data['about'] = AboutSetting::first();
        $data['company'] = User::where('type', 'Company')->get();
        return $data;

    }
    function getHomepage()
    {
        $data = [];
        $data['company'] = User::where('type', 'Company')->get();
        $data['job'] = Job::get();
        return $data;
    }
}
