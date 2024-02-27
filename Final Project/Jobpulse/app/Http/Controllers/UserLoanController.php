<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoanInfo;
use App\Models\Loan;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Role::all();
        try {
            $rows = Loan::all();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $data = $request->validate([
            'loan_id' => 'required',
            'customer_id' => 'required',
        ]);

        // $existing = Loan::where('name', $data['name'])->first();
        // // return Auth::id();
        // if (!$existing) {
        //     $loan = Loan::create([
        //         'name' => $data['name'],
        //         'type' => $data['type'],
        //         'user_id' => Auth::id(),
        //     ]);

        //     return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        // }
        
        //    $customer_loan =  CustomerLoanInfo::updateOrCreate(
            //         [
                //             'loan_id' => $request->loan_id,
        //             'customer_id' => $request->customer_id,
        //         ],
        //         $other_inf
        //     );
        try {
            foreach ($request->other_infos as $key => $value) {

                CustomerLoanInfo::updateOrCreate(
                            [
                                'loan_id' => $request->loan_id,
                                'customer_id' => $request->customer_id,
                                'key' => $key,
                            ],
                            [
                                'value' => $value,
                            ]
                        );
            }
        return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception) {
            //throw $th;
            return response(['error' => 1, 'message' => 'Something Wrong'], 409);
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \App\Models\Role $role
     */
    public function show(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|min:1'
            ]);
            $loan_id = $request->input('id');
            $rows = Loan::where('id', $loan_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|Role
     */
    public function update(Request $request, ?Role $role = null)
    {

        try {
            $request->validate([
                'id' => 'required|string|min:1',
                'name' => 'required|string|min:2',
            ]);
            // return $request;
            $loan_id = $request->input('id');
            Loan::where('id', $loan_id)->update([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request->id;
        try {
            //don't allow changing the admin slug, because it will make the routes inaccessbile due to faile ability check
            Loan::where('id', $request->id)->delete();

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
