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
    private function ensureBlogAccess(Request $request): ?\Illuminate\Http\JsonResponse
    {
        if ($request->user()->hasRole('Company') && !$request->user()->hasActivePlugin('blog_management')) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Blog Management feature is not active for this company.',
            ]);
        }

        return null;
    }

    function CreateBlog(Request $request)
    {
        try {
            if ($response = $this->ensureBlogAccess($request)) {
                return $response;
            }

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
            if ($response = $this->ensureBlogAccess($request)) {
                return $response;
            }

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
            if ($response = $this->ensureBlogAccess($request)) {
                return $response;
            }

            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = Blog::query()
                ->with([
                    'user:id,firstName,lastName'
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

    function BlogDetails(Request $request)
    {
        try {
            $request->validate(["id" => 'required|string']);

            $rows = Blog::query()
                ->with([
                    'user:id,firstName,lastName'
                ])
                ->where( 'id' , $request->input('id') )
                ->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function BlogList(Request $request)
    {
        try {
            if ($response = $this->ensureBlogAccess($request)) {
                return $response;
            }

            $rows = Blog::query()
                ->with([
                    'user:id,firstName,lastName'
                ])
                ->get();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function UpdateBlog(Request $request)
    {
        try {
            if ($response = $this->ensureBlogAccess($request)) {
                return $response;
            }

            $user_id = Auth::id();
            $request->validate([
                'text' => 'required',
                "id" => 'required|string',
            ]);
            Blog::where('id', $request->input('id'))->update([
                'text' => $request->input('text'),
            ]);

            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
