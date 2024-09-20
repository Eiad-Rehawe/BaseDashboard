<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required_if:phone,=,null', 'string', 'email', 'max:50', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => [
                'required_if:email,=,null',
                'unique:users,phone',
            
            ],
            'address'=>'required|string',
            // 'gender'=>'required|integer'
        ]);
        $gender = '';
      
        if(!empty($request->gender)){
            $gender = $request->gender;
        }else{
            $gender = 1;
        }
       
     if(!empty($request->email) && empty($request->phone)){
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
            'gender'=> $gender,
            'address'=>$request->address
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/register')->with(['status'=>__('messages.please check your email to verified your email')]);
     }
     if(!empty($request->phone) && empty($request->email)){
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            'gender'=> $gender,
            'address'=>$request->address
        ]);

             Auth::login($user);
             return redirect(RouteServiceProvider::WELCOME);

     }

     if(!empty($request->email) && !empty($request->phone)){
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            'gender'=> $gender,
            'address'=>$request->address
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/register')->with(['status'=>__('messages.please check your email to verified your email')]);
     }
     
    }
}
