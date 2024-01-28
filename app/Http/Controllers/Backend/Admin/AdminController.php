<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login_form(){
        return view('Backend.Pages.Login.Login');
    }
    public function login_functionality(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }else{
           // Session::flash('error-message','Invalid Email or Password');
            return redirect()->back()->with('error-message','Invalid Email or Password');
        }
    }
    public function dashboard()
    {
        return view('Backend.Pages.Dashboard.index');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    

}
