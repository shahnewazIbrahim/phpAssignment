<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Traits\DateFilter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
// use Spatie\Permission\Contracts\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        // $this->middleware('role:Super Admin|Administrator');
    }

    public function index()
    {
        try {
            // return
            $roles = Role::all();

            if (request()->search) {
                $this->search($roles, ['id', 'name']);
            }
            return response()->json(['status' => 'success', 'rows' => $roles]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json(['status' => 'fail',  'message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        $arr = ['Admin List', 'Admin Create', 'Admin Edit', 'Admin Download', 'Roles List', 'Roles Create', 'Roles Edit', 'Roles Download'];
        $roleArr = json_decode(json_encode(request()->user()->allRoles, true));
        $permissions = Permission::when(!in_array(1, $roleArr), function ($query) use ($arr) {
            $query->whereNotIn('name', $arr);
        })
            ->pluck('name', 'id');


        return Inertia::render('Role/Create', [
            "data" => [
                'role' => new Role(),
                'permissions' => $permissions
            ]
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create($this->validateData($request));
        $role->syncPermissions($request->permissions);

        return redirect()
            ->route('roles.show', $role->id)
            ->with('status', 'The record has been added successfully.');
    }

    public function show(Role $role)
    {
        try {
            return $role;
            $role->load('permissions:name');
            $role->allPermission = Permission::pluck('name', 'id');
            return response()->json(['status' => 'success', 'rows' => $role]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public function edit(Role $role)
    {
        $roleArr = json_decode(json_encode(request()->user()->allRoles, true));
        $arr = ['Admin List', 'Admin Create', 'Admin Edit', 'Admin Download', 'Roles List', 'Roles Create', 'Roles Edit', 'Roles Download'];
        $permissions = Permission::when(!in_array(1, $roleArr), function ($query) use ($arr) {
            $query->whereNotIn('name', $arr);
        })
            ->pluck('name', 'id');
        if (!in_array(1, $roleArr)) {
            return abort(404);
        }

        return Inertia::render('Role/Edit', [
            "data" => [
                'role' => $role->load('permissions'),
                'permissions' => $permissions
            ]
        ]);
    }

    public function update(Request $request, Role $role)
    {
        if (in_array($role->name, ['Super Admin', 'Administrator'])) {
            return abort(404);
        }
        // return $request;
        $role->update($this->validateData($request, $role->id));
        $role->syncPermissions($request->permissions);
        return redirect()
            ->route('roles.show', $role->id)
            ->with('status', 'The record has been update successfully.');
    }
}