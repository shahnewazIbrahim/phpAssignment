<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    // app/Http/Controllers/DashboardController.php

    public function index()
    {
        // Logic to retrieve sales figures for today, yesterday, this month, and last month
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Retrieve sales figures for today, yesterday, this month, and last month
        $todaySales = $this->getSalesForDateRange($today, $today);
        $yesterdaySales = $this->getSalesForDateRange($yesterday, $yesterday);
        $thisMonthSales = $this->getSalesForDateRange($thisMonth, Carbon::now());
        $lastMonthSales = $this->getSalesForDateRange($lastMonth, $lastMonth->endOfMonth());
        
        return view('dashboard', [
            'todaySales' => $todaySales,
            'yesterdaySales' => $yesterdaySales,
            'thisMonthSales' => $thisMonthSales,
            'lastMonthSales' => $lastMonthSales,
        ]);
    }

}
