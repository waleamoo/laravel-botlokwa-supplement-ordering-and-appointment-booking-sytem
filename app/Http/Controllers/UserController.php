<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function postRegister(Request $request){
        // validate fields 
        $this->validate($request, [
            'id' => 'required|min:6|max:13',
            'first_name' => 'required|min:3|max:40',
            'last_name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:40',
            'password_confirmation' => 'required|min:3|max:40|same:password',
            'tel_h' => 'required|numeric|min:10',
            'tel_w' => 'required|numeric|min:10',
            'tel_c' => 'required|numeric|min:10',
            'reference' => 'required|min:3',
            'dob' => 'required|date',
            'addr' => 'required|min:10',
            'gender' => 'required|min:1'
        ]);
        // register user 
        $user = new User([
            'id' => $request['id'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'tel_h' => $request['tel_h'],
            'tel_w' => $request['tel_w'],
            'tel_c' => $request['tel_c'],
            'reference' => $request['reference'],
            'dob' => $request['dob'],
            'addr' => $request['addr'],
            'gender' => $request['gender']
        ]);
        $user->save();
        // Login the user 
        Auth::login($user);
        // create a session for them
        $request->session()->put('sid', mt_rand(1, 1000));
        // redirect to their profile 
        return redirect()->route('getProfile');
    }

    public function getProfile(){
        $appointments = DB::table('bookings')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $orders = Auth::user()->orders->sortByDesc('order_id');
        

        return view('user.profile', ['appointments' => $appointments, 'orders' => $orders]);
    }

    public function postLogin(Request $request){
        // validate the credentials
        $this->validate($request, [
            'email' => 'required|min:5',
            'password' => 'required|min:3|max:40'
        ]);
        
        // authenticate the users
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']], $request->remember)){
            $request->session()->put('sid', mt_rand(1, 1000));
            return redirect()->route('getProfile');
        }else{
            return redirect()->back()
            ->with('error', 'Your credentials does not match our records. Try Again.')
            ->withInput(['email' => $request['email']]);
        }
    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route("home");
    }

    /////////////////////////////////////////////////
    public function getSupplementCategory($id){
        
    }
}
