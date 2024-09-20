<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthenticatController extends Controller
{
    use ResponseTrait;
    public function register(RegisterCustomerRequest $request)
    {
        try {
            set_time_limit(120);
           
            $phone = !empty($request['phone']) ? trim($request->code . $request->phone) : null;

            $user = User::create(array_merge($request->except('password', 'phone', 'code', 'gender', 'otp'), ['password' => Hash::make($request->password), 'phone' => $phone]));
            $token = $user->createToken(uniqid())->plainTextToken;
            // event(new Registered($user));
            if (!empty($user->email)) {
                // $std = User::where('email','=',$request->email)->update(['otp' => $otp]);
                // if ($std == true) {
                // **At the top** use Illuminate\Support\Facades\Mail as Mail;
                $otp = rand(10000, 99999);

                Mail::raw('Your OTP: ' . $otp, function ($message) use ($request) {
                    $message->to($request->email)->subject("OTP Email");
                });

                return $this->returnSuccess(__('messages.please check your email to verified your email'), 200);

                // }else{
                //     return $this->returnError(__('messages.Email not found'),400);
                // }

            } else {
                return $this->returnSuccess(__('messages.register success'), 200);

            }
            // return $this->returnData($user, true,200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function verifyOtp(RegisterCustomerRequest $request)
    {
        try {

            $user = User::where('email', $request->email)->first();
            if ($user) {

                if ($user->email_verified_at == null) {
                    $user->otp = null;
                    $user->email_verified_at = now();
                    $user->save();
                    $token = $user->createToken(uniqid())->plainTextToken;
                    return $this->returnData($token, true, 200);

                } else {
                    return $this->returnError(__('messages.This account was recently verified. Please log in'), 400);

                }
                //    elseif($user->email_verified_at != null ){
                //         return $this->returnError(__('messages.This account was recently verified. Please log in'),400);
                //     }

            } else {
                return $this->returnError(__('messages.Email not found'), 400);
            }

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    public function login(RegisterCustomerRequest $request)
    {
        try {

            if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->email_or_phone)->first();
            } else {
                $user = User::where('phone', $request->email_or_phone)->first();
            }

            if (!$user || !Hash::check($request->password, $user->password)) {

                return $this->returnError(__('messages.Login invalid'), 503);
            } if(empty($user->email_verified_at)){
                return $this->returnError(__('messages.please activate your account'), 503);

            }
            else {

                $token = $user->createToken(uniqid())->plainTextToken;

                return $this->returnData($token, true, 200);
            }
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }

    }

    // method for user logout and delete token

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->returnSuccess(__('validation.logout success'), 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }

    }

}
