<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HcpLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // a guest can login to the admin side
    }
    
    public function getAdminLogin()
    {
        return view('hcp.login'); 
    }
    
    public function postAdminLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        // login with the admin credentials 
        $credentials = ['hcp_email' => $request->email, 'password' => $request->password]; // do not change the password to admin_password
        if(Auth::guard('hcp')->attempt($credentials, $request->remember))
        {
            return redirect()->intended(route('getAdminDashboard'));
        }
        // where the login is unsuccessful 
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Your administrative credentials does not match. Try again.');
    }
}
