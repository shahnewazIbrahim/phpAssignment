<?php

namespace App\Http\Controllers;

use App\Models\AboutSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AboutSettingController extends Controller
{

    function CreateAboutSetting(Request $request)
    {
        // return $request;
        try {
            $user_id = Auth::id();
            $request->validate([
                'banner' => 'required',
                'companyHistory' => 'required',
                'ourVision' => 'required',
            ]);

            if ($request->file('banner')) {
                $file = $request->file('banner');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $url = 'uploads/' . $filename;
            }

            AboutSetting::create([
                'banner' => $url,
                'company_history' => $request->input('companyHistory'),
                'our_vision' => $request->input('ourVision'),
                // 'user_id' => $user_id
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function DeleteAboutSetting(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                "id" => 'required|string',
            ]);
            AboutSetting::where('id', $request->input('id'))->where('user_id', $user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function AboutSettingByID(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);
            $rows = AboutSetting::where('id', $request->input('id'))->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function AboutSettingList(Request $request)
    {
        try {
            $rows = AboutSetting::get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function UpdateAboutSetting(Request $request)
    {
        // return $request;
        try {
            $user_id = Auth::id();
            $request->validate([
                // 'banner' => 'required',
                'companyHistory' => 'required',
                'ourVision' => 'required',
                "id" => 'required|string',
            ]);
            if ($request->file('banner')) {
                $file = $request->file('banner');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $url = 'uploads/' . $filename;
                AboutSetting::where('id', $request->input('id'))->update([
                    'banner' => $url,
                ]);
            }
            AboutSetting::where('id', $request->input('id'))->update([
                // 'banner' => $request->input('banner'),
                'company_history' => $request->input('companyHistory'),
                'our_vision' => $request->input('ourVision'),
            ]);

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
