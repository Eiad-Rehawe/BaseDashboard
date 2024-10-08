<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        // return 'wdd';
        if ($request->user()->hasVerifiedEmail()) {
            // Auth::login($request->user());
            return redirect()->intended(RouteServiceProvider::WELCOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            // Auth::login($request->user());
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::WELCOME.'?verified=1');
      
    }
}
