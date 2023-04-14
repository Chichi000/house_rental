<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{   
    //login users
    public function postSignin(Request $request)
    {   
        //validate email and password
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:8'
        ]);

        //check if email and password is correct
        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {

            //$name for only notification
            $name = auth()->user()->name;

            //if when user is tenant
            if (auth()->user()->role === 'tenant') {
                return redirect()->route('tenant.profile')->with('success', 'Welcome, ' . $name. '');
            } 
            
            //elseif when user is landlord
            else if (auth()->user()->role === 'landlord') {
                return redirect()->route('landlord.profile')->with('success', 'Welcome, ' . $name. '');
            } 
            
            //else is for user admin
            else {
                return redirect()->route('getHome');
            }

        } 
        
        //return else when failed to entered correct email or password
        else {
            return redirect()->back()->with('error', 'Email-Address or Password Are Wrong.');
        }

    }

    public function getSignin(){
        return view('users.signinform');
    }

    public function getTsignup(){
        return view('users.signuptenant');
    }

    public function getLsignup(){
        return view('users.signuplandlord');
    }
    
    //logout users
    public function logout()
    {   
        Auth::logout();
        return redirect()->route('getHome');
    }
}