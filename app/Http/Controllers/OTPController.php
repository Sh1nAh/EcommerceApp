<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OTPController extends Controller
{
    public function send(Request $request)
    {
        $request->validate(['phone_number' => 'required|string']);

        $otp = rand(100000, 999999);
        $phoneNumber = $request->input('phone_number');


        // Save OTP in database
        OTP::updateOrCreate(
            ['phone_number' => $phoneNumber],
            ['otp' => $otp, 'created_at' => now()]
        );

        // Send OTP via SMS
        $this->sendSms($phoneNumber, $otp);

        return back()->with('message', 'OTP sent to your phone!');
    }

    protected function sendSms($phoneNumber, $otp)
{
    $sid = config('services.twilio.sid');
    $token = config('services.twilio.token');
    $twilioNumber = config('services.twilio.number');

    // Check if credentials are set
    if (!$sid || !$token || !$twilioNumber) {
        throw new \Exception("Twilio credentials are not set properly.");
    }

    $client = new Client($sid, $token);
    $client->messages->create($phoneNumber, [
        'from' => $twilioNumber,
        'body' => "Your OTP is: $otp"
    ]);
}

    public function verify(Request $request)
{
    $request->validate([
        'phone_number' => 'required|string',
        'otp' => 'required|integer'
    ]);

    $otpRecord = OTP::where('phone_number', $request->input('phone_number'))->first();

    if ($otpRecord && $otpRecord->otp == $request->input('otp')) {
        // OTP verified, proceed with user authentication or registration
        $otpRecord->delete(); // Clean up
        return redirect()->route('home')->with('message', 'OTP verified!');
    }

    return back()->withErrors(['otp' => 'Invalid OTP.']);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'phone_number' => 'required|string',
        'new_password' => 'required|string|min:8'
    ]);

    // Find user by phone number and update password
    $user = User::where('phone_number', $request->input('phone_number'))->first();
    if ($user) {
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->route('login')->with('message', 'Password reset successfully.');
    }

    return back()->withErrors(['phone_number' => 'User not found.']);
}

}
