<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
  
    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
        
    //     $request->authenticate();
      
    //     $request->session()->regenerate();
    
    //     return redirect()->intended(RouteServiceProvider::WELCOME);
        
    // }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            
        ]);

        $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $login_type => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $user_1 = User::where('phone', $request->email)->first();
            if (isset($user) && $user != null && $user->email != null && $user->email_verified_at != null ) {

                $request->session()->regenerate();

                return redirect('/');
            }  
             
          elseif(isset($user_1) && $user_1 != null && $user_1->phone != null ) {

                $request->session()->regenerate();

                return redirect('/');
            }
            if (isset($user) && $user != null && $user->email != null && $user->email_verified_at == null ) {
                return redirect('/login')->with(['status'=>__('messages.please check your email to verified your email')]);
                }
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    /**
     * Destroy an authenticated session.
     */
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
