<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class VerifyOTPController extends Controller
{
    public function verify(Request $request, User $user)
    {
        $otp = auth()->user()->otp();
        // dd(Cache::get($otp));
        // validate OTP
        $validateOTP = $this->OTPValidation($request);

        // Run validation
        if ($validateOTP->fails()) {
            return back()->withErrors(
                $validateOTP->errors()
            );
            // return response()->json([
            //     'success' => false,
            //     'message' => $validateOTP->errors(),
            //     'status' => 400,
            // ]);
        }

        // dd(Cache::get($otp) . '-' . $request->otp);
        if (request('otp') == Cache::get($otp)) {
            auth()->user()->update(['is_verified' => true]);
            // dd(auth()->user()->id);

            // return response(null, 201);
            return redirect()->route('home');
        }

        return back()->withErrors('Invalid or Expired OTP.');
        // dd(false);
    }

    public function OTPValidation(Request $request)
    {
        $valMsg = [
            'otp.required' => 'Please provide your O.T.P',
        ];

        return Validator::make($request->all(), [
            'otp' => 'required|numeric',
        ], $valMsg);
    }

    public function showOTPForm()
    {
        return view('auth.otp.verify');
    }
}
