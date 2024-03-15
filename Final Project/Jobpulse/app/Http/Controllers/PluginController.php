<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PluginController extends Controller
{
    function PluginList(Request $request)
    {
        // dd(Auth::user());
        try {
            $user_id = Auth::id();
            $rows = Plugin::with('user')->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginCreate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:2',
                'user_id' => 'required',
                // 'active' => 'required'
            ]);
            // $user_id = Auth::id();
            Plugin::create([
                'name' => $request->input('name'),
                'active' => 0,
                'user_id' => $request->input('user_id'),
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $user_id = Auth::id();
            $plugin_id = $request->input('id');
            Plugin::where('id', $plugin_id)->where('user_id', $user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function PluginByID(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|min:1'
            ]);
            $plugin_id = $request->input('id');
            $user_id = Auth::id();
            $rows = Plugin::where('id', $plugin_id)->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function PluginUpdate(Request $request)
    {

        try {
            $request->validate([
                'id' => 'required|string|min:1',
                'name' => 'required|string|min:2',
                'user_id' => 'required'
            ]);

            $plugin_id = $request->input('id');
            $user_id = Auth::id();
            Plugin::where('id', $plugin_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginActive(Request $request)
    {

        try {
            $request->validate([
                'id' => 'required|string|min:1',
            ]);

            $plugin_id = $request->input('id');
            Plugin::where('id', $plugin_id)->update([
                'active' => 1,
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
