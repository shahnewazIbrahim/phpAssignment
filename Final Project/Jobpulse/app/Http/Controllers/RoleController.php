<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
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
            $rows = Role::all();
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
        if (Role::where('name', $request->name)->exists()) {
            return response(['error' => 1, 'message' => 'role already exists'], 409);
        }

        $role = Role::create($request->except('permission'));
        return $request;
        $permissions = $request->input('permission') ? $request->input('permission') : [];

        $role->givePermissionTo($permissions);
        return $role;
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
            $role_id = $request->input('id');
            $rows = Role::where('id', $role_id)->first();
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

            $role_id = $request->input('id');
            $role = Role::find($role_id);
            $role->update([
                'name' => $request->input('name'),
            ]);
            if ($request->slug) {
                if ($role->slug != 'admin' && $role->slug != 'super-admin') {
                    //don't allow changing the admin slug, because it will make the routes inaccessbile due to faile ability check
                    $role->slug = $request->slug;
                    $role->update();
                }
            }
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
    public function destroy(Role $role)
    {
        if ($role->slug != 'admin' && $role->slug != 'super-admin') {
            //don't allow changing the admin slug, because it will make the routes inaccessbile due to faile ability check
            $role->delete();

            return response(['error' => 0, 'message' => 'role has been deleted']);
        }

        return response(['error' => 1, 'message' => 'you cannot delete this role'], 422);
    }
}
