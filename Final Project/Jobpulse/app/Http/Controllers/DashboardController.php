<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function countProperties() {
        $data = [];
        try {
            $data['categoryCount'] = Category::count();
            $data['productCount'] = Product::count();
            $data['invoiceCount'] = Invoice::count();

            return response()->json(['status' => 'success', 'data' => $data]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
