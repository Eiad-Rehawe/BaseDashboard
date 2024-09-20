<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ResponseTrait;

    // public function submitForgetPasswordForm(Request $request)
    // {

    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'email' => 'required|email|exists:users,email',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 422);
    //         }
    //         $user = DB::table('users')->where('email', $request->email)->first();

    //         if (!$user) {
    //             return response()->json(['message' => __('messages.Email not found')], 404);
    //         }

    //             $status = Password::broker('users')->sendResetLink(
    //             $request->only('email')
    //         );

    //         return $status === Password::RESET_LINK_SENT
    //             ? $this->returnSuccess( __("messages.We have emailed your password reset link."),200)
    //             :$this->returnError( __($status),400);

    //     } catch (\Exception $e) {
    //         return $this->returnError($e->getMessage(), 500);
    //     }

    // }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => __('messages.Email not found')], 404);
        }
        $token = rand(10000, 99999); // Generate 5-digit token

        // Store the token in the password resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // Send the token to the user's email
        $user->notify(new ResetPasswordNotification($token));

        return $this->returnSuccess(__("messages.We have emailed your password reset link."), 200);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|digits:5',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$passwordReset) {
            return response()->json(['message' => __('messages.Invalid token or email.')], 400);
        }

        if (!Hash::check($request->token, $passwordReset->token)) {
            return response()->json(['message' => __('messages.Invalid token.')], 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset record
        DB::table('password_resets')->where('email', $request->email)->delete();

        return $this->returnSuccess(__('messages.Your password has been changed!'), 200);
    }

}
