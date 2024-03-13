<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Mail\OTPMail;
use App\Models\Candidate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    function UserRegistration(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'mobile' => 'required|string|max:50',
                'type' => 'required|string',
                'password' => 'required|string|min:3'
            ]);
            // return ucfirst($request->input('type'));
            $user = User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'type' => ucfirst($request->input('type')),
                'password' => Hash::make($request->input('password'))
            ]);
            // return $user;
            $user->assignRole(ucfirst($request->input('type')));
            return response()->json(['status' => 'success', 'message' => 'User Registration Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function UserLogin(Request $request)
    {
        try {
            // if($request->input('type') == 'candidate' || $request->input('type') == 'owner') {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);

            $user = User::where('email', $request->input('email'))->whereIn('type', ['company', 'candidate'])->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            $roles = $user->roles->pluck('name')->toArray() ?? [];

            $token = $user->createToken('authToken', $roles)->plainTextToken;

            return response()->json(['status' => 'success', 'message' => 'Login Successful', 'token' => $token]);
            // }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function UserOwnerLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);

            $user = User::where('email', $request->input('email'))->where('type', 'owner')->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            $roles = $user->roles->pluck('name')->toArray() ?? [];

            $token = $user->createToken('authToken', $roles)->plainTextToken;

            return response()->json(['status' => 'success', 'message' => 'Login Successful', 'token' => $token]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function SendOTPCode(Request $request)
    {

        try {

            $request->validate([
                'email' => 'required|string|email|max:50'
            ]);

            $email = $request->input('email');
            $otp = rand(1000, 9999);
            $count = User::where('email', '=', $email)->count();

            if ($count == 1) {
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email', '=', $email)->update(['otp' => $otp]);
                return response()->json(['status' => 'success', 'message' => '4 Digit OTP Code has been send to your email !']);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Invalid Email Address'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function VerifyOTP(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'otp' => 'required|string|min:4'
            ]);

            $email = $request->input('email');
            $otp = $request->input('otp');

            $user = User::where('email', '=', $email)->where('otp', '=', $otp)->first();

            if (!$user) {
                return response()->json(['status' => 'fail', 'message' => 'Invalid OTP']);
            }

            // CurrentDate-UpdatedTe=4>Min

            User::where('email', '=', $email)->update(['otp' => '0']);

            $roles = $user->roles->pluck('slug')->all();

            $token = $user->createToken('authToken', $roles)->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'OTP Verification Successful', 'token' => $token]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ResetPassword(Request $request)
    {

        try {
            $request->validate([
                'password' => 'required|string|min:3'
            ]);
            $id = Auth::id();
            $password = $request->input('password');
            User::where('id', '=', $id)->update(['password' => Hash::make($password)]);
            return response()->json(['status' => 'success', 'message' => 'Request Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(),]);
        }
    }

    function UserLogout(Request $request)
    {
        // return $request->user();
        $request->user()->tokens()->delete();
        return redirect('/');
    }

    function UserProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->assignedRole = $user->roles->pluck('name')->toArray() ?? [];
        $user->applied_ids = $user->applyJob->pluck('job_id')->toArray() ?? [];
        return $user;
    }

    function CandidateProfile(Request $request)
    {
        $user = User::with('candidate')->findOrFail(Auth::id());
        $user->assignedRole = $user->roles->pluck('name')->toArray() ?? [];
        return $user;
    }

    function CandidateCreate(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                // 'image' => 'required',
                'ssc' => 'required',
                'hsc' => 'required',
                'hons' => '',
                'other_qualification' => 'required',
            ]);
            // return dd($request->file('image'));
            if ($request->file('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/candidate/'), $filename);
                $url = 'uploads/candidate/' . $filename;
            }

            Candidate::where('user_id', '=', Auth::id())->updateOrCreate(
                [
                    'user_id' => Auth::id()
                ],
                [
                    'image'                 => $url ?? "",
                    'address'               => $request->input('address'),
                    'ssc'                   => $request->input('ssc'),
                    'hsc'                   => $request->input('hsc'),
                    'hons'                  => $request->input('hons'),
                    'other_qualification'   => $request->input('other_qualification'),
                ]
            );
            return response()->json(['status' => 'success', 'message' => "Request Successful"]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function UpdateProfile(Request $request)
    {

        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'mobile' => 'required|string|max:50',
            ]);

            User::where('id', '=', Auth::id())->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'mobile' => $request->input('mobile'),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Request Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
