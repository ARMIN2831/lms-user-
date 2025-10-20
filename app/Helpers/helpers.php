<?php

use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Mail;


if (!function_exists('sendOTPCode')) {
    function sendOTPCode($type,$userId,$userModel,$userField)
    {
        $existingOtp = UserNotification::where('model_id', $userId)
            ->where('model_type', $userModel)
            ->where('type', $type)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if ($existingOtp) {
            $remainingTime = Carbon::now()->diffInSeconds($existingOtp->expires_at);
            throw new HttpResponseException(
                response()->json([
                   'status' => 'success',
                   'message' => trans('messages.OTP_is_valid'),
                   'remaining_time' => round($remainingTime),
                   'verified' => 0,
               ], 200)
            );
        }


        //$otpCode = rand(10000, 99999);
        $otpCode = 11111;
        if ($type == "email"){
            Mail::raw('Your verify code: ' . $otpCode, function ($message) use ($userField) {
                $message->to($userField)
                    ->subject('Verify Email');
            });
        }
        if ($type == "mobile"){
            //
        }
        UserNotification::updateOrCreate(
            [
                'model_type' => $userModel,
                'model_id' => $userId,
                'type' => $type,
            ], [
                'type' => $type,
                'message' => $otpCode,
                'model_type' => $userModel,
                'model_id' => $userId,
                'expires_at' => Carbon::now()->addMinutes(2),
            ]
        );
    }
}


if (!function_exists('verifyOTPCode')) {
    function verifyOTPCode($type,$userId,$userModel,$code)
    {
        $otpRecord = UserNotification::where('type', $type)
            ->where('model_id',$userId)
            ->where('model_type',$userModel)
            ->first();

        if (!$otpRecord) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'message' => trans('messages.otp_not_found'),
                ], 404)
            );
        }
        if (Carbon::now()->gt($otpRecord->expires_at)) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'message' => trans('messages.otp_expired'),
                ], 400)
            );
        }
        if ($code != $otpRecord->message) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'message' => trans('messages.otp_invalid'),
                ], 400)
            );
        }
        $otpRecord->delete();
    }
}
