<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Job;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function countProperties() {
        $data = [];
        try {
            $data['applyJobCount'] = ApplyJob::count();
            $data['employeeCount'] = Employee::count();
            $data['jobCount'] = Job::count();

            return response()->json(['status' => 'success', 'data' => $data]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
