<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'phone_number' => 'required|unique:users',
                'password' => 'required|min:6'
            ]);

            User::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => 'client'
            ]);

            return redirect('/login')->with('success','Account created successfully');

        } catch (\Exception $e) {

            return back()->with('error',$e->getMessage());

        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ]);
    
        if(Auth::attempt($credentials))
        {
            // regenerate session after login
            $request->session()->regenerate();
    
            if(Auth::user()->role == 'admin'){
                return redirect('/admin/dashboard');
            }
    
            if(Auth::user()->role == 'admin'){
                return redirect('/admin/dashboard')
                    ->with('success','Login successful. Welcome back!');
            }
            
            return redirect('/client/dashboard')
                ->with('success','Login successful. Welcome back!');
        }
    
        return back()->with('error','Invalid phone number or password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success','Logged out successfully');
    }

    public function showAdminLogin()
    {
        return view('auth.admin_login');
    }



    public function adminLogin(Request $request)
    {

        $request->validate([
            'phone_number'=>'required',
            'password'=>'required'
        ]);


        $credentials = [
            'phone_number'=>$request->phone_number,
            'password'=>$request->password,
            'role'=>'admin'
        ];


        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            return redirect('/admin/dashboard')
                ->with('success','Admin login successful');

        }

        return back()->with('error','Invalid admin credentials');

    }
}