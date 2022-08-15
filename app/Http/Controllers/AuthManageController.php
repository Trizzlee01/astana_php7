<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Auth;
// use Session;
// use App\User;
use App\Models\UserPabrik;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthManageController extends Controller
{
    public function viewLogin()
    {
        return view('login');
    }

    public function verifyLogin(Request $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
    		return redirect('/dashboard');
    	}
    	Session::flash('login_failed', 'Username atau password salah');
    	
    	return redirect('/login');


        // $credentials = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required'
        // ]);

        // if(Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }

        // return back()->with('loginError', 'Login failed');
        // return back();


        // pake type
        // $temp = User::where('user_type', $request->user_type)->where('username', $request->username)->first();
        
        // if($temp === null)
        // {
        //     return redirect('/login');
        // }
        // else{
        //     if(Hash::check($request->password, $temp->password, []))
        //     {
        //         Auth::loginUsingId($temp->id);
        //         return redirect('/dashboard');
        //     }
        // }

        // return Hash::check($suppliedPassword, Auth::user()->password, []);


        // if(Auth::attempt($request->only('username', 'password'))){

        //     $temp = User::firstWhere('username', request('username'));
        //     if($temp->user_type == $request->user_type){
        //         return redirect('/dashboard');
        //     }
        //     return redirect('/login');
    	// }

        // return back()->with('loginError', 'Login Failed!');
        // return redirect('/login');

    }

    public function logoutProcess(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
