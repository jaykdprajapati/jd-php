<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Mail;
use App\Mail\InviteEmail;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InviteController extends Controller
{

    public function index()
    {
        return view('invite');
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->save();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        $tokenData = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $link = config('base_url') . 'password/reset/' . $tokenData->token . '?email=' . urlencode($user->email);

        $mailData = ['to' => $request->email,'name' => $request->name, 'reset_link' => $link];
        Mail::send(new InviteEmail($mailData)); 

        return back()->with('success', 'Invitation has been sent successfully');
    }

}