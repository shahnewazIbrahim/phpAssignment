<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function AdminList(Request $request)
    {
        // dd(Auth::user());
        try {
            $rows = User::all();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function AdminCreate(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'mobile' => 'required|string|max:50',
                'password' => 'required|string|min:3'
            ]);
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function AdminDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);

            $admin_id = $request->input('id');
            User::where('id', $admin_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function AdminByID(Request $request)
    {

        try {
            $request->validate([
                'id' => 'required|min:1'
            ]);
            $admin_id = $request->input('id');
            $rows = User::where('id', $admin_id)->first();

            // return
            $roleIds = Role::whereIn('name', $rows->getRoleNames())->pluck('id');

            $rows->roleIds = $roleIds;
            $allRoles = Role::pluck('name', 'id');

            $rows->allRoles = $allRoles;

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function AdminUpdate(Request $request)
    {
        // return $request;
        try {
            $request->validate([
                'id' => 'required|string|min:1',
                'firstName' => 'required|string|min:3',
                'lastName' => 'required|string|min:3',
                'email' => 'required|email',
                'roleId' => 'required',
                'mobile' => 'required|string|max:11',
            ]);

            $admin_id = $request->input('id');
            $user = User::where('id', $admin_id)->first();
            $user->where('id', $admin_id)->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
            ]);
            $role = Role::find($request->input('roleId'));
            if (!$user->roles()->find($request->input('roleId'))) {
                $user->roles()->attach($role);
            }
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
