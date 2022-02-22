<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VerifyOTPController extends Controller
{
    public function verify(Request $request, User $user)
    {
        $otp = auth()->user()->otp();
        // dd(Cache::get($otp) . '-' . $request->otp);
        if (request('otp') == Cache::get($otp)) {
            auth()->user()->update(['is_verified' => true]);
            // dd(auth()->user()->id);

            // return response(null, 201);
            return redirect()->route('home');
        }

        dd($user->otpKey());
        // dd(false);
    }

    public function showOTPForm()
    {
        return view('auth.otp.verify');
    }
}
