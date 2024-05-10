<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Carbon\Carbon;
use \Validator;


class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login berhasil');
        }
        
        
        return back()->with('error', 'Email or Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function resetform(Request $request,$token)
    {   
        $email  = $request->email;
        return view('reset',compact('email','token'));
    }

    public function resetPassword(Request $request){
        
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
        'password' => 'required',
        'token' => 'required' ]);


    if ($validator->fails()) {
        return redirect()->back()->with('error','Please complete the form');
    }

    $password = $request->password;

    $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

    if (!$tokenData) return view('auth.passwords.email');

    $user = User::where('email', $tokenData->email)->first();

    if (!$user) return redirect()->back()->with('email','Email not found');

    $user->password = \Hash::make($password);
    $user->update(); 

    Auth::login($user);
    DB::table('password_reset_tokens')->where('email', $user->email)->delete();

    
    return redirect('/login')->with('success', 'Password has changed successfully please login.');
    

}

}
