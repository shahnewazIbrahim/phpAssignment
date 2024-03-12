<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BlogController extends Controller
{

    function CreateBlog(Request $request)
    {
        // return $request;
        try {
            $user_id = Auth::id();
            $request->validate([
                'text' => 'required|string',
            ]);


            Blog::create([
                'text' => $request->input('text'),
                'user_id' => $user_id
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function DeleteBlog(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                "id" => 'required|string',
            ]);
            Blog::where('id', $request->input('id'))->where('user_id', $user_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function BlogByID(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = Blog::query()
                ->with([
                    'user:id,firstName'
                ])
                ->where([
                    'id' => $request->input('id'),
                    'user_id' => $user_id,
                ])
                ->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function BlogList(Request $request)
    {
        try {
            $rows = Blog::query()
                ->with([
                    'user:id,firstName'
                ])
                ->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function UpdateBlog(Request $request)
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
                Blog::where('id', $request->input('id'))->update([
                    'banner' => $url,
                ]);
            }
            Blog::where('id', $request->input('id'))->update([
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
