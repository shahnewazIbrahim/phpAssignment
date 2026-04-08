<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PluginController extends Controller
{
    private const FEATURE_CATALOG = [
        'blog_management' => 'Allows a company to use the Blog module from the dashboard and publish employer-written posts.',
        'featured_jobs' => 'Highlights the company\'s jobs on the homepage and job listings so openings get more visibility.',
    ];

    private function ensureOwnerAccess(Request $request): ?\Illuminate\Http\JsonResponse
    {
        if (!$request->user() || !$request->user()->hasRole('Owner')) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Only the owner can manage feature access.',
            ]);
        }

        return null;
    }

    function PluginList(Request $request)
    {
        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $rows = Plugin::with('user:id,firstName,lastName')->get();
            return response()->json([
                'status' => 'success',
                'rows' => $rows,
                'catalog' => self::FEATURE_CATALOG,
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginCreate(Request $request)
    {
        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $request->validate([
                'name' => 'required|string|min:2',
                'slug' => 'required|string|min:2',
                'description' => 'nullable|string',
                'user_id' => 'required',
            ]);

            $slug = Str::slug($request->input('slug'), '_');

            if (!array_key_exists($slug, self::FEATURE_CATALOG)) {
                return response()->json(['status' => 'fail', 'message' => 'Invalid feature selected']);
            }

            Plugin::updateOrCreate(
                [
                    'slug' => $slug,
                    'user_id' => $request->input('user_id'),
                ],
                [
                    'name' => $request->input('name'),
                    'description' => $request->input('description') ?: self::FEATURE_CATALOG[$slug],
                    'active' => 0,
                ]
            );
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginDelete(Request $request)
    {
        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $plugin_id = $request->input('id');
            Plugin::where('id', $plugin_id)->delete();
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    function PluginByID(Request $request)
    {
        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $request->validate([
                'id' => 'required|min:1'
            ]);
            $plugin_id = $request->input('id');
            $rows = Plugin::where('id', $plugin_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function PluginUpdate(Request $request)
    {

        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $request->validate([
                'id' => 'required|string|min:1',
                'name' => 'required|string|min:2',
                'slug' => 'required|string|min:2',
                'description' => 'nullable|string',
                'user_id' => 'required'
            ]);

            $plugin_id = $request->input('id');
            $slug = Str::slug($request->input('slug'), '_');

            if (!array_key_exists($slug, self::FEATURE_CATALOG)) {
                return response()->json(['status' => 'fail', 'message' => 'Invalid feature selected']);
            }

            Plugin::where('id', $plugin_id)->update([
                'name' => $request->input('name'),
                'slug' => $slug,
                'description' => $request->input('description') ?: self::FEATURE_CATALOG[$slug],
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function PluginActive(Request $request)
    {

        try {
            if ($response = $this->ensureOwnerAccess($request)) {
                return $response;
            }

            $request->validate([
                'id' => 'required|string|min:1',
            ]);

            $plugin_id = $request->input('id');
            $plugin = Plugin::findOrFail($plugin_id);
            $plugin->update([
                'active' => !$plugin->active,
            ]);
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
